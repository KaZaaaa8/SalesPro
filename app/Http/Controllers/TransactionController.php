<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Transaction;
use App\Models\Product;
use App\Models\TransactionItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;

class TransactionController extends Controller
{
    public function index()
    {
        $transactions = Transaction::with(['user', 'items.product'])
            ->latest()
            ->paginate(10);
        return view('transactions.index', compact('transactions'));
    }

    public function create()
    {
        $products = Product::where('stock', '>', 0)->get();
        $categories = Category::where('is_active', true)->get();
        return view('transactions.create', compact('categories', 'products'));
    }


    public function store(Request $request)
    {
        $validated = $request->validate([
            'items' => 'required|array',
            'items.*.product_id' => 'required|exists:products,id',
            'items.*.quantity' => 'required|integer|min:1',
            'payment_method' => 'required|in:cash,card',
            'payment_amount' => 'required|numeric|min:0',
            'notes' => 'nullable|string'
        ]);

        try {
            DB::beginTransaction();

            $subtotal = 0;
            foreach ($request->items as $item) {
                $product = Product::findOrFail($item['product_id']);
                if ($product->stock < $item['quantity']) {
                    throw new \Exception("Insufficient stock for product: {$product->name}");
                }
                $subtotal += $product->price * $item['quantity'];
            }

            $tax = $subtotal * 0.11; // 11% tax
            $total_amount = $subtotal + $tax;

            if ($request->payment_amount < $total_amount) {
                throw new \Exception("Insufficient payment amount");
            }

            $transaction = Transaction::create([
                'invoice_number' => 'INV-' . date('Ymd') . '-' . rand(1000, 9999),
                'user_id' => Auth::id(),
                'subtotal' => $subtotal,
                'tax' => $tax,
                'total_amount' => $total_amount,
                'payment_method' => $request->payment_method,
                'payment_amount' => $request->payment_amount,
                'change_amount' => $request->payment_amount - $total_amount,
                'status' => 'completed',
                'notes' => $request->notes
            ]);

            foreach ($request->items as $item) {
                $product = Product::findOrFail($item['product_id']);

                TransactionItem::create([
                    'transaction_id' => $transaction->id,
                    'product_id' => $product->id,
                    'quantity' => $item['quantity'],
                    'price' => $product->price,
                    'subtotal' => $product->price * $item['quantity']
                ]);

                $product->decrement('stock', $item['quantity']);
            }

            DB::commit();
            return redirect()->route('transactions.show', $transaction)
                ->with('success', 'Transaction completed successfully.');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', $e->getMessage());
        }
    }


    public function show(Transaction $transaction)
    {
        $transaction->load(['user', 'items.product']);
        return view('transactions.show', compact('transaction'));
    }

    public function printReceipt(Transaction $transaction)
    {
        $transaction->load(['user', 'items.product']);
        $pdf = PDF::loadView('transactions.receipt', compact('transaction'));
        return $pdf->download("receipt-{$transaction->invoice_number}.pdf");
    }

    public function report(Request $request)
    {
        $query = Transaction::query()->where('status', 'completed');

        if ($request->filled('start_date')) {
            $query->whereDate('created_at', '>=', $request->start_date);
        }

        if ($request->filled('end_date')) {
            $query->whereDate('created_at', '<=', $request->end_date);
        }

        $transactions = $query->get();
        $totalSales = $transactions->sum('total_amount');
        $totalTransactions = $transactions->count();

        return view('transactions.report', compact(
            'transactions',
            'totalSales',
            'totalTransactions'
        ));
    }
}
