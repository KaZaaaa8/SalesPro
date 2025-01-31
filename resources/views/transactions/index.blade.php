<x-app-layout>
    <div class="mb-6">
        <div class="flex justify-between items-center">
            <div>
                <h1 class="text-2xl font-bold text-white">Transaksi</h1>
                <p class="text-gray-400 mt-1">Kelola data transaksi penjualan</p>
            </div>
            <a href="{{ route('transactions.create') }}"
                class="flex items-center px-4 py-2 bg-blue-900/50 text-blue-400 rounded-lg border border-blue-700 hover:bg-blue-900/70 transition-colors duration-200">
                <i class="fas fa-plus mr-2"></i>
                <span>Transaksi Baru</span>
            </a>
        </div>
    </div>

    <!-- Filter dan Pencarian -->
    <div class="bg-dark-secondary rounded-xl border border-gray-700 p-4 mb-6">
        <form action="{{ route('transactions.index') }}" method="GET" class="grid grid-cols-1 md:grid-cols-4 gap-4">
            <input type="text"
                name="search"
                value="{{ request('search') }}"
                placeholder="Cari nomor invoice..."
                class="px-4 py-2 bg-dark-primary border border-gray-700 rounded-lg text-gray-300 focus:outline-none focus:border-blue-500">

            <select name="status"
                class="px-4 py-2 bg-dark-primary border border-gray-700 rounded-lg text-gray-300 focus:outline-none focus:border-blue-500">
                <option value="">Semua Status</option>
                <option value="completed" {{ request('status') === 'completed' ? 'selected' : '' }}>Selesai</option>
                <option value="pending" {{ request('status') === 'pending' ? 'selected' : '' }}>Pending</option>
                <option value="cancelled" {{ request('status') === 'cancelled' ? 'selected' : '' }}>Dibatalkan</option>
            </select>

            <div class="flex gap-2">
                <button type="submit"
                    class="px-4 py-2 bg-blue-900/50 text-blue-400 rounded-lg border border-blue-700 hover:bg-blue-900/70 transition-colors duration-200">
                    <i class="fas fa-search mr-2"></i>Filter
                </button>
                @if(request()->hasAny(['search', 'status']))
                <a href="{{ route('transactions.index') }}"
                    class="px-4 py-2 bg-gray-800 text-gray-300 rounded-lg hover:bg-gray-700 transition-colors duration-200">
                    Reset
                </a>
                @endif
            </div>
        </form>
    </div>

    <!-- Ringkasan Transaksi -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-6">
        <div class="bg-dark-secondary rounded-xl border border-gray-700 p-6">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-blue-900/30 mr-4">
                    <i class="fas fa-receipt text-xl text-blue-400"></i>
                </div>
                <div>
                    <p class="text-sm text-gray-400">Total Transaksi</p>
                    <p class="text-2xl font-bold text-white">{{ $transactions->total() }}</p>
                </div>
            </div>
        </div>

        <div class="bg-dark-secondary rounded-xl border border-gray-700 p-6">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-green-900/30 mr-4">
                    <i class="fas fa-money-bill text-xl text-green-400"></i>
                </div>
                <div>
                    <p class="text-sm text-gray-400">Total Penjualan</p>
                    <p class="text-2xl font-bold text-green-400">Rp {{ number_format($transactions->sum('total_amount'), 0, ',', '.') }}</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Tabel Transaksi -->
    <div class="bg-dark-secondary rounded-xl border border-gray-700">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-700">
                <thead>
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">Invoice</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">Tanggal</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">Total</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">Pembayaran</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">Status</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-700">
                    @forelse($transactions as $transaction)
                    <tr class="hover:bg-gray-800/50 transition-colors duration-200">
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-300">
                            {{ $transaction->invoice_number }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-300">
                            {{ $transaction->created_at->format('d/m/Y H:i') }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-green-400">
                            Rp {{ number_format($transaction->total_amount, 0, ',', '.') }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-300">
                            {{ ucfirst($transaction->payment_method) }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="px-2 py-1 text-xs rounded-full 
                                    {{ $transaction->status === 'completed' ? 'bg-green-900/50 text-green-400 border border-green-700' : 
                                       ($transaction->status === 'pending' ? 'bg-yellow-900/50 text-yellow-400 border border-yellow-700' : 
                                       'bg-red-900/50 text-red-400 border border-red-700') }}">
                                {{ $transaction->status === 'completed' ? 'Selesai' : 
                                       ($transaction->status === 'pending' ? 'Pending' : 'Dibatalkan') }}
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm">
                            <div class="flex space-x-3">
                                <a href="{{ route('transactions.show', $transaction) }}"
                                    class="text-gray-400 hover:text-gray-300">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="{{ route('transactions.print', $transaction) }}"
                                    class="text-blue-400 hover:text-blue-300">
                                    <i class="fas fa-print"></i>
                                </a>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="px-6 py-4 text-center text-gray-400">
                            Tidak ada transaksi yang ditemukan
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($transactions->hasPages())
        <div class="px-6 py-4 border-t border-gray-700">
            {{ $transactions->links() }}
        </div>
        @endif
    </div>
</x-app-layout>