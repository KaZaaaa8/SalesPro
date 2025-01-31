<x-app-layout>
    <div class="max-w-4xl mx-auto">
        <div class="mb-6">
            <div class="flex justify-between items-center">
                <div>
                    <h1 class="text-2xl font-bold text-white">Create Category</h1>
                    <p class="text-gray-400 mt-1">Add a new category to your product catalog</p>
                </div>
                <a href="{{ route('categories.index') }}"
                    class="flex items-center px-4 py-2 bg-gray-800 text-gray-300 rounded-lg hover:bg-gray-700 transition-colors duration-200">
                    <i class="fas fa-arrow-left mr-2"></i>
                    <span>Back to Categories</span>
                </a>
            </div>
        </div>

        <div class="bg-dark-secondary rounded-xl border border-gray-700 p-6">
            <form action="{{ route('categories.store') }}" method="POST" class="space-y-6">
                @csrf

                <div class="grid grid-cols-1 gap-6">
                    <!-- Name Input -->
                    <div class="bg-dark-primary p-4 rounded-lg border border-gray-700">
                        <label class="block text-sm font-medium text-gray-300 mb-2">
                            <i class="fas fa-tag mr-2"></i>Category Name
                        </label>
                        <input type="text"
                            name="name"
                            value="{{ old('name') }}"
                            class="w-full px-4 py-2 bg-dark-secondary border border-gray-600 rounded-lg text-gray-300 focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500"
                            placeholder="Enter category name"
                            required>
                        @error('name')
                        <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Description Input -->
                    <div class="bg-dark-primary p-4 rounded-lg border border-gray-700">
                        <label class="block text-sm font-medium text-gray-300 mb-2">
                            <i class="fas fa-align-left mr-2"></i>Description
                        </label>
                        <textarea name="description"
                            rows="4"
                            class="w-full px-4 py-2 bg-dark-secondary border border-gray-600 rounded-lg text-gray-300 focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500"
                            placeholder="Enter category description">{{ old('description') }}</textarea>
                        @error('description')
                        <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Status Toggle -->
                    <div class="bg-dark-primary p-4 rounded-lg border border-gray-700">
                        <label class="block text-sm font-medium text-gray-300 mb-2">
                            <i class="fas fa-toggle-on mr-2"></i>Status
                        </label>
                        <div class="flex items-center space-x-3">
                            <div class="flex items-center">
                                <input type="radio"
                                    name="is_active"
                                    value="1"
                                    {{ old('is_active', true) ? 'checked' : '' }}
                                    class="h-4 w-4 text-blue-500 border-gray-700 focus:ring-blue-500 bg-dark-secondary">
                                <label class="ml-2 text-sm text-gray-300">Active</label>
                            </div>
                            <div class="flex items-center">
                                <input type="radio"
                                    name="is_active"
                                    value="0"
                                    {{ old('is_active') === '0' ? 'checked' : '' }}
                                    class="h-4 w-4 text-blue-500 border-gray-700 focus:ring-blue-500 bg-dark-secondary">
                                <label class="ml-2 text-sm text-gray-300">Inactive</label>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="flex justify-end space-x-4 pt-6 border-t border-gray-700">
                    <a href="{{ route('categories.index') }}"
                        class="px-6 py-2 bg-gray-800 text-gray-300 rounded-lg hover:bg-gray-700 transition-colors duration-200">
                        Cancel
                    </a>
                    <button type="submit"
                        class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors duration-200">
                        Create Category
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>