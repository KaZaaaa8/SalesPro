<x-app-layout>
    <!-- Stats Grid -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-6">
        <div class="bg-dark-secondary rounded-xl border border-gray-700 p-6">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-gray-400 text-sm font-medium">Total Sales</h3>
                <span class="bg-blue-900/50 text-blue-400 text-xs font-medium px-2.5 py-1 rounded-lg border border-blue-700">Today</span>
            </div>
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-blue-900/30 mr-4">
                    <i class="fas fa-dollar-sign text-xl text-blue-400"></i>
                </div>
                <div>
                    <h4 class="text-2xl font-bold text-white">{{ number_format($totalSales, 2) }}</h4>
                    <p class="text-gray-400 text-sm">Total Revenue</p>
                </div>
            </div>
        </div>

        <div class="bg-dark-secondary rounded-xl border border-gray-700 p-6">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-gray-400 text-sm font-medium">Products</h3>
                <span class="bg-green-900/50 text-green-400 text-xs font-medium px-2.5 py-1 rounded-lg border border-green-700">Stock</span>
            </div>
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-green-900/30 mr-4">
                    <i class="fas fa-box text-xl text-green-400"></i>
                </div>
                <div>
                    <h4 class="text-2xl font-bold text-white">{{ $totalProducts }}</h4>
                    <p class="text-gray-400 text-sm">Total Items</p>
                </div>
            </div>
        </div>

        <div class="bg-dark-secondary rounded-xl border border-gray-700 p-6">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-gray-400 text-sm font-medium">Users</h3>
                <span class="bg-purple-900/50 text-purple-400 text-xs font-medium px-2.5 py-1 rounded-lg border border-purple-700">Active</span>
            </div>
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-purple-900/30 mr-4">
                    <i class="fas fa-users text-xl text-purple-400"></i>
                </div>
                <div>
                    <h4 class="text-2xl font-bold text-white">{{ $totalUsers }}</h4>
                    <p class="text-gray-400 text-sm">Team Members</p>
                </div>
            </div>
        </div>

        <div class="bg-dark-secondary rounded-xl border border-gray-700 p-6">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-gray-400 text-sm font-medium">Transactions</h3>
                <span class="bg-orange-900/50 text-orange-400 text-xs font-medium px-2.5 py-1 rounded-lg border border-orange-700">Daily</span>
            </div>
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-orange-900/30 mr-4">
                    <i class="fas fa-receipt text-xl text-orange-400"></i>
                </div>
                <div>
                    <h4 class="text-2xl font-bold text-white">{{ $recentTransactions->count() }}</h4>
                    <p class="text-gray-400 text-sm">Today's Sales</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Transactions Table -->
    <div class="bg-dark-secondary rounded-xl border border-gray-700 p-6">
        <div class="flex items-center justify-between mb-6">
            <h3 class="text-xl font-semibold text-white">Recent Transactions</h3>
            <a href="{{ route('transactions.index') }}"
                class="px-4 py-2 bg-blue-900/50 text-blue-400 rounded-lg border border-blue-700 hover:bg-blue-900/70 transition-colors duration-200">
                View All
            </a>
        </div>
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-700">
                <thead>
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">Invoice</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">Date</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">Cashier</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">Total</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">Status</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-700">
                    @foreach($recentTransactions as $transaction)
                    <tr class="hover:bg-gray-800/50 transition-colors duration-200">
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-300">
                            {{ $transaction->invoice_number }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-300">
                            {{ $transaction->created_at->format('d/m/Y H:i') }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-300">
                            {{ $transaction->user->name }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-300">
                            ${{ number_format($transaction->total_amount, 2) }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                       {{ $transaction->status === 'completed' ? 'bg-green-900/50 text-green-400 border border-green-700' : 
                                          'bg-yellow-900/50 text-yellow-400 border border-yellow-700' }}">
                                {{ ucfirst($transaction->status) }}
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm">
                            <a href="{{ route('transactions.show', $transaction) }}"
                                class="text-blue-400 hover:text-blue-300 mr-3">
                                <i class="fas fa-eye"></i>
                            </a>
                            <a href="{{ route('transactions.print', $transaction) }}"
                                class="text-green-400 hover:text-green-300">
                                <i class="fas fa-print"></i>
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>