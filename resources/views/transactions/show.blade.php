<x-app-layout>
    <div class="max-w-4xl mx-auto">
        <div class="mb-6">
            <div class="flex justify-between items-center">
                <div>
                    <h1 class="text-2xl font-bold text-white">Detail Transaksi</h1>
                    <p class="text-gray-400 mt-1">{{ $transaction->invoice_number }}</p>
                </div>
                <div class="flex gap-3">
                    <a href="{{ route('transactions.index') }}"
                        class="flex items-center px-4 py-2 bg-gray-800 text-gray-300 rounded-lg hover:bg-gray-700">
                        <i class="fas fa-arrow-left mr-2"></i>
                        <span>Kembali</span>
                    </a>
                    <a href="{{ route('transactions.print', $transaction) }}"
                        class="flex items-center px-4 py-2 bg-blue-900/50 text-blue-400 rounded-lg border border-blue-700 hover:bg-blue-900/70">
                        <i class="fas fa-print mr-2"></i>
                        <span>Cetak</span>
                    </a>
                </div>
            </div>
        </div>

        <div class="bg-dark-secondary rounded-xl border border-gray-700 p-6">
            <!-- Header Info -->
            <div class="grid grid-cols-2 gap-6 mb-6">
                <div>
                    <p class="text-sm text-gray-400">Kasir</p>
                    <p class="text-gray-300">{{ $transaction->user->name ?? 'User tidak ditemukan' }}</p>
                </div>
                <div>
                    <p class="text-sm text-gray-400">Tanggal</p>
                    <p class="text-gray-300">{{ $transaction->created_at->format('d/m/Y H:i') }}</p>
                </div>
            </div>

            <!-- Items -->
            <div class="border-t border-gray-700 py-4">
                <h3 class="text-lg font-semibold text-white mb-4">Detail Item</h3>
                <div class="space-y-3">
                    @foreach($transaction->items as $item)
                    <div class="flex justify-between items-center">
                        <div>
                            <p class="text-gray-300">{{ $item->product->name ?? 'Produk tidak ditemukan' }}</p>
                            <p class="text-sm text-gray-500">{{ $item->quantity }} x {{ number_format($item->price, 0, ',', '.') }}</p>
                        </div>
                        <p class="text-gray-300">Rp {{ number_format($item->subtotal, 0, ',', '.') }}</p>
                    </div>
                    @endforeach
                </div>
            </div>

            <!-- Payment Details -->
            <div class="border-t border-gray-700 pt-4 space-y-2">
                <div class="flex justify-between text-sm">
                    <span class="text-gray-400">Subtotal</span>
                    <span class="text-gray-300">Rp {{ number_format($transaction->subtotal, 0, ',', '.') }}</span>
                </div>
                <div class="flex justify-between text-sm">
                    <span class="text-gray-400">PPN (12%)</span>
                    <span class="text-gray-300">Rp {{ number_format($transaction->tax, 0, ',', '.') }}</span>
                </div>
                <div class="flex justify-between text-lg font-semibold">
                    <span class="text-gray-400">Total</span>
                    <span class="text-white">Rp {{ number_format($transaction->total_amount, 0, ',', '.') }}</span>
                </div>
                <div class="flex justify-between text-sm pt-2 border-t border-gray-700">
                    <span class="text-gray-400">Pembayaran ({{ ucfirst($transaction->payment_method) }})</span>
                    <span class="text-gray-300">Rp {{ number_format($transaction->payment_amount, 0, ',', '.') }}</span>
                </div>
                <div class="flex justify-between text-sm">
                    <span class="text-gray-400">Kembalian</span>
                    <span class="text-gray-300">Rp {{ number_format($transaction->change_amount, 0, ',', '.') }}</span>
                </div>
            </div>

            @if($transaction->notes)
            <div class="mt-6 pt-4 border-t border-gray-700">
                <p class="text-sm text-gray-400">Catatan:</p>
                <p class="text-gray-300 mt-1">{{ $transaction->notes }}</p>
            </div>
            @endif
        </div>
    </div>
</x-app-layout>