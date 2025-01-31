<x-app-layout>
    <div class="max-w-4xl mx-auto">
        <div class="mb-6">
            <div class="flex justify-between items-center">
                <div>
                    <h1 class="text-2xl font-bold text-white">Edit Transaction</h1>
                    <p class="text-gray-400 mt-1">Update transaction details</p>
                </div>
                <a href="{{ route('transactions.index') }}" 
                   class="flex items-center px-4 py-2 bg-gray-800 text-gray-300 rounded-lg hover:bg-gray-700 transition-colors duration-200">
                    <i class="fas fa-arrow-left mr-2"></i>
                    <span>Back to Transactions</span>
                </a>
            </div>
        </div>

        <div class="bg-dark-secondary rounded-xl border border-gray-700 p-6">
            <form action="{{ route('transactions.update', $transaction) }}" method="POST" class="space-y-6">
                @csrf
                @method('PUT')
                
                <div class="grid grid-cols-1 gap-6">
                    <!-- Transaction Type -->
                    <div class="bg-dark-primary p-4 rounded-lg border border-gray-700">
                        <label class="block text-sm font-medium text-gray-300 mb-2">
                            <i class="fas fa-exchange-alt mr-2"></i>Transaction Type
                        </label>
                        <select name="type" 
                                class="w-full px-4 py-2 bg-dark-secondary border border-gray-600 rounded-lg text-gray-300 focus:outline-none focus:border-blue-500">
                            <option value="income" {{ old('type', $transaction->type) == 'income' ? 'selected' : '' }}>Income</option>
                            <option value="expense" {{ old('type', $transaction->type) == 'expense' ? 'selected' : '' }}>Expense</option>
                        </select>
                        @error('type')
                            <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Amount -->
                    <div class="bg-dark-primary p-4 rounded-lg border border-gray-700">
                        <label class="block text-sm font-medium text-gray-300 mb-2">
                            <i class="fas fa-money-bill mr-2"></i>Amount
                        </label>
                        <div class="relative">
                            <span class="absolute left-3 top-2 text-gray-500">$</span>
                            <input type="number" 
                                   name="amount" 
                                   value="{{ old('amount', $transaction->amount) }}"
                                   step="0.01"
                                   class="w-full pl-8 pr-4 py-2 bg-dark-secondary border border-gray-600 rounded-lg text-gray-300 focus:outline-none focus:border-blue-500"
                                   required>
                        </div>
                        @error('amount')
                            <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Category -->
                    <div class="bg-dark-primary p-4 rounded-lg border border-gray-700">
                        <label class="block text-sm font-medium text-gray-300 mb-2">
                            <i class="fas fa-folder mr-2"></i>Category
                        </label>
                        <select name="category_id" 
                                class="w-full px-4 py-2 bg-dark-secondary border border-gray-600 rounded-lg text-gray-300 focus:outline-none focus:border-blue-500">
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" 
                                        {{ old('category_id', $transaction->category_id) == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('category_id')
                            <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Date -->
                    <div class="bg-dark-primary p-4 rounded-lg border border-gray-700">
                        <label class="block text-sm font-medium text-gray-300 mb-2">
                            <i class="fas fa-calendar mr-2"></i>Date
                        </label>
                        <input type="date" 
                               name="date" 
                               value="{{ old('date', $transaction->date->format('Y-m-d')) }}"
                               class="w-full px-4 py-2 bg-dark-secondary border border-gray-600 rounded-lg text-gray-300 focus:outline-none focus:border-blue-500">
                        @error('date')
                            <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Description -->
                    <div class="bg-dark-primary p-4 rounded-lg border border-gray-700">
                        <label class="block text-sm font-medium text-gray-300 mb-2">
                            <i class="fas fa-align-left mr-2"></i>Description
                        </label>
                        <textarea name="description" 
                                  rows="3"
                                  class="w-full px-4 py-2 bg-dark-secondary border border-gray-600 rounded-lg text-gray-300 focus:outline-none focus:border-blue-500"
                                  placeholder="Enter transaction description">{{ old('description', $transaction->description) }}</textarea>
                        @error('description')
                            <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Payment Method -->
                    <div class="bg-dark-primary p-4 rounded-lg border border-gray-700">
                        <label class="block text-sm font-medium text-gray-300 mb-2">
                            <i class="fas fa-credit-card mr-2"></i>Payment Method
                        </label>
                        <select name="payment_method" 
                                class="w-full px-4 py-2 bg-dark-secondary border border-gray-600 rounded-lg text-gray-300 focus:outline-none focus:border-blue-500">
                            <option value="cash" {{ old('payment_method', $transaction->payment_method) == 'cash' ? 'selected' : '' }}>Cash</option>
                            <option value="card" {{ old('payment_method', $transaction->payment_method) == 'card' ? 'selected' : '' }}>Card</option>
                            <option value="transfer" {{ old('payment_method', $transaction->payment_method) == 'transfer' ? 'selected' : '' }}>Bank Transfer</option>
                        </select>
                        @error('payment_method')
                            <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Status -->
                    <div class="bg-dark-primary p-4 rounded-lg border border-gray-700">
                        <label class="block text-sm font-medium text-gray-300 mb-2">
                            <i class="fas fa-check-circle mr-2"></i>Status
                        </label>
                        <select name="status" 
                                class="w-full px-4 py-2 bg-dark-secondary border border-gray-600 rounded-lg text-gray-300 focus:outline-none focus:border-blue-500">
                            <option value="completed" {{ old('status', $transaction->status) == 'completed' ? 'selected' : '' }}>Completed</option>
                            <option value="pending" {{ old('status', $transaction->status) == 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="cancelled" {{ old('status', $transaction->status) == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                        </select>
                        @error('status')
                            <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="flex justify-end space-x-4 pt-6 border-t border-gray-700">
                    <a href="{{ route('transactions.index') }}" 
                       class="px-6 py-2 bg-gray-800 text-gray-300 rounded-lg hover:bg-gray-700 transition-colors duration-200">
                        Cancel
                    </a>
                    <button type="submit" 
                            class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors duration-200">
                        Update Transaction
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
