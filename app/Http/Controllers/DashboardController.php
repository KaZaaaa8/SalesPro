<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $totalSales = Transaction::where('status', 'completed')->sum('total_amount');
        $totalProducts = Product::count();
        $totalUsers = User::count();
        $recentTransactions = Transaction::with(['user', 'items.product'])
            ->latest()
            ->take(5)
            ->get();

        return view('dashboard', compact(
            'totalSales',
            'totalProducts',
            'totalUsers',
            'recentTransactions'
        ));
    }
}
