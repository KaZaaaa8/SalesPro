<x-app-layout>
    <div class="bg-dark-secondary rounded-xl border border-gray-700 p-6">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-xl font-semibold text-white">Products Management</h2>
            <a href="{{ route('products.create') }}"
                class="px-4 py-2 bg-blue-900/50 text-blue-400 rounded-lg border border-blue-700 hover:bg-blue-900/70 transition-colors duration-200">
                <i class="fas fa-plus mr-2"></i>Add Product
            </a>
        </div>

        <!-- Search and Filter -->
        <div class="flex gap-4 mb-6">
            <div class="flex-1">
                <input type="text"
                    placeholder="Search products..."
                    class="w-full px-4 py-2 bg-dark-primary border border-gray-700 rounded-lg text-gray-300 focus:outline-none focus:border-blue-500">
            </div>
            <select class="px-4 py-2 bg-dark-primary border border-gray-700 rounded-lg text-gray-300 focus:outline-none focus:border-blue-500">
                <option value="">All Categories</option>
                @foreach($categories as $category)
                <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
        </div>

        <!-- Products Table -->
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-700">
                <thead>
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">Image</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">Name</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">SKU</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">Category</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">Price</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">Stock</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">Status</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-700">
                    @foreach($products as $product)
                    <tr class="hover:bg-gray-800/50 transition-colors duration-200">
                        <td class="px-6 py-4 whitespace-nowrap">
                            <img src="{{ $product->image_path ? asset('storage/' . $product->image_path) : asset('images/no-image.png') }}"
                                alt="{{ $product->name }}"
                                class="h-10 w-10 rounded-lg object-cover">
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-300">
                            {{ $product->name }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-300">
                            {{ $product->sku }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-300">
                            {{ $product->category->name }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-300">
                            ${{ number_format($product->price, 2) }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm">
                            <span class="px-2 py-1 text-xs rounded-full 
                                {{ $product->stock > 10 ? 'bg-green-900/50 text-green-400 border border-green-700' : 
                                   ($product->stock > 0 ? 'bg-yellow-900/50 text-yellow-400 border border-yellow-700' : 
                                   'bg-red-900/50 text-red-400 border border-red-700') }}">
                                {{ $product->stock }}
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="px-2 py-1 text-xs rounded-full 
                                {{ $product->is_active ? 'bg-green-900/50 text-green-400 border border-green-700' : 
                                   'bg-red-900/50 text-red-400 border border-red-700' }}">
                                {{ $product->is_active ? 'Active' : 'Inactive' }}
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm">
                            <a href="{{ route('products.edit', $product) }}"
                                class="text-blue-400 hover:text-blue-300 mr-3">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="{{ route('products.destroy', $product) }}"
                                method="POST"
                                class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                    class="text-red-400 hover:text-red-300"
                                    onclick="return confirm('Are you sure you want to delete this product?')">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="mt-4">
            {{ $products->links() }}
        </div>
    </div>
</x-app-layout>