<x-app-layout>
    <!-- Header Section -->
    <div class="mb-6">
        <div class="flex justify-between items-center">
            <h1 class="text-2xl font-bold text-white">Categories</h1>
            <a href="{{ route('categories.create') }}"
                class="flex items-center px-4 py-2 bg-blue-900/50 text-blue-400 rounded-lg border border-blue-700 hover:bg-blue-900/70 transition-colors duration-200">
                <i class="fas fa-plus mr-2"></i>
                <span>Add Category</span>
            </a>
        </div>
        <p class="text-gray-400 mt-1">Manage your product categories</p>
    </div>

    <!-- Search and Filter Section -->
    <div class="bg-dark-secondary rounded-xl border border-gray-700 p-4 mb-6">
        <form action="{{ route('categories.index') }}" method="GET" class="flex flex-col md:flex-row gap-4">
            <div class="flex-1">
                <input type="text"
                    name="search"
                    value="{{ request('search') }}"
                    placeholder="Search categories..."
                    class="w-full px-4 py-2 bg-dark-primary border border-gray-700 rounded-lg text-gray-300 focus:outline-none focus:border-blue-500">
            </div>
            <div class="flex gap-4">
                <select name="status"
                    class="px-4 py-2 bg-dark-primary border border-gray-700 rounded-lg text-gray-300 focus:outline-none focus:border-blue-500">
                    <option value="">All Status</option>
                    <option value="active" {{ request('status') === 'active' ? 'selected' : '' }}>Active</option>
                    <option value="inactive" {{ request('status') === 'inactive' ? 'selected' : '' }}>Inactive</option>
                </select>
                <button type="submit"
                    class="px-4 py-2 bg-blue-900/50 text-blue-400 rounded-lg border border-blue-700 hover:bg-blue-900/70 transition-colors duration-200">
                    <i class="fas fa-search mr-2"></i>Filter
                </button>
                @if(request()->hasAny(['search', 'status']))
                <a href="{{ route('categories.index') }}"
                    class="px-4 py-2 bg-gray-800 text-gray-300 rounded-lg hover:bg-gray-700 transition-colors duration-200">
                    Clear
                </a>
                @endif
            </div>
        </form>
    </div>

    <!-- Categories Table -->
    <div class="bg-dark-secondary rounded-xl border border-gray-700">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-700">
                <thead>
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">Name</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">Description</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">Products</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">Created</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">Status</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-700">
                    @forelse($categories as $category)
                    <tr class="hover:bg-gray-800/50 transition-colors duration-200">
                        <td class="px-6 py-4">
                            <div class="flex items-center">
                                <div class="h-8 w-8 rounded-full bg-gray-700 flex items-center justify-center">
                                    <i class="fas fa-folder text-gray-400"></i>
                                </div>
                                <span class="ml-3 text-sm text-gray-300">{{ $category->name }}</span>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <p class="text-sm text-gray-300 line-clamp-2">
                                {{ $category->description ?: 'No description' }}
                            </p>
                        </td>
                        <td class="px-6 py-4">
                            <span class="px-2 py-1 text-xs rounded-full bg-purple-900/50 text-purple-400 border border-purple-700">
                                {{ $category->products_count }} products
                            </span>
                        </td>
                        <td class="px-6 py-4 text-sm text-gray-300">
                            {{ $category->created_at->format('M d, Y') }}
                        </td>
                        <td class="px-6 py-4">
                            <span class="px-2 py-1 text-xs rounded-full 
                                    {{ $category->is_active ? 'bg-green-900/50 text-green-400 border border-green-700' : 
                                       'bg-red-900/50 text-red-400 border border-red-700' }}">
                                {{ $category->is_active ? 'Active' : 'Inactive' }}
                            </span>
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex space-x-3">
                                <a href="{{ route('categories.edit', $category) }}"
                                    class="text-blue-400 hover:text-blue-300 transition-colors duration-200">
                                    <i class="fas fa-edit"></i>
                                </a>
                                @if($category->products_count === 0)
                                <form action="{{ route('categories.destroy', $category) }}"
                                    method="POST"
                                    class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="text-red-400 hover:text-red-300 transition-colors duration-200"
                                        onclick="return confirm('Are you sure you want to delete this category?')">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                                @endif
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="px-6 py-4 text-center text-gray-400">
                            <div class="flex flex-col items-center">
                                <i class="fas fa-folder-open text-4xl mb-2"></i>
                                <p>No categories found</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($categories->hasPages())
        <div class="px-6 py-4 border-t border-gray-700">
            {{ $categories->links() }}
        </div>
        @endif
    </div>
</x-app-layout>