<x-app-layout>
    <div class="bg-dark-secondary rounded-xl border border-gray-700 p-6">
        <div class="mb-6">
            <h2 class="text-xl font-semibold text-white">Add New Product</h2>
            <p class="text-gray-400 mt-1">Create a new product in your inventory</p>
        </div>

        <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Left Column -->
                <div class="space-y-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-300 mb-2">Product Name</label>
                        <input type="text"
                            name="name"
                            value="{{ old('name') }}"
                            class="w-full px-4 py-2 bg-dark-primary border border-gray-700 rounded-lg text-gray-300 focus:outline-none focus:border-blue-500"
                            required>
                        @error('name')
                        <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-300 mb-2">SKU</label>
                        <input type="text"
                            name="sku"
                            value="{{ old('sku') }}"
                            class="w-full px-4 py-2 bg-dark-primary border border-gray-700 rounded-lg text-gray-300 focus:outline-none focus:border-blue-500"
                            required>
                        @error('sku')
                        <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-300 mb-2">Category</label>
                        <select name="category_id"
                            class="w-full px-4 py-2 bg-dark-primary border border-gray-700 rounded-lg text-gray-300 focus:outline-none focus:border-blue-500"
                            required>
                            <option value="">Select Category</option>
                            @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                            @endforeach
                        </select>
                        @error('category_id')
                        <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-300 mb-2">Price</label>
                        <div class="relative">
                            <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-400">$</span>
                            <input type="number"
                                name="price"
                                value="{{ old('price') }}"
                                step="0.01"
                                class="w-full pl-8 px-4 py-2 bg-dark-primary border border-gray-700 rounded-lg text-gray-300 focus:outline-none focus:border-blue-500"
                                required>
                        </div>
                        @error('price')
                        <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Right Column -->
                <div class="space-y-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-300 mb-2">Stock</label>
                        <input type="number"
                            name="stock"
                            value="{{ old('stock') }}"
                            class="w-full px-4 py-2 bg-dark-primary border border-gray-700 rounded-lg text-gray-300 focus:outline-none focus:border-blue-500"
                            required>
                        @error('stock')
                        <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-300 mb-2">Description</label>
                        <textarea name="description"
                            rows="4"
                            class="w-full px-4 py-2 bg-dark-primary border border-gray-700 rounded-lg text-gray-300 focus:outline-none focus:border-blue-500">{{ old('description') }}</textarea>
                        @error('description')
                        <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-300 mb-2">Product Image</label>
                        <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-700 border-dashed rounded-lg"
                            id="dropZone"
                            ondrop="dropHandler(event)"
                            ondragover="dragOverHandler(event)">
                            <div class="space-y-1 text-center">
                                <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48">
                                    <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                </svg>

                                <img id="preview" class="mx-auto h-32 hidden object-cover rounded-lg" src="#" alt="Preview">

                                <div class="flex text-sm text-gray-400">
                                    <label class="relative cursor-pointer rounded-md font-medium text-blue-400 hover:text-blue-300 focus-within:outline-none">
                                        <span>Upload a file</span>
                                        <input type="file"
                                            name="image"
                                            id="image"
                                            accept="image/*"
                                            class="hidden"
                                            onchange="handleImage(this)">
                                    </label>
                                    <p class="pl-1">or drag and drop</p>
                                </div>

                                <p class="text-xs text-gray-400">
                                    PNG, JPG, GIF up to 2MB
                                </p>
                            </div>
                        </div>
                        @error('image')
                        <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex items-center">
                        <input type="checkbox"
                            name="is_active"
                            value="1"
                            {{ old('is_active', true) ? 'checked' : '' }}
                            class="h-4 w-4 text-blue-500 border-gray-700 rounded focus:ring-blue-500 bg-dark-primary">
                        <label class="ml-2 block text-sm text-gray-300">
                            Active Product
                        </label>
                    </div>
                </div>
            </div>

            <div class="flex justify-end space-x-4 mt-6">
                <a href="{{ route('products.index') }}"
                    class="px-4 py-2 bg-gray-800 text-gray-300 rounded-lg hover:bg-gray-700 transition-colors duration-200">
                    Cancel
                </a>
                <button type="submit"
                    class="px-4 py-2 bg-blue-900/50 text-blue-400 rounded-lg border border-blue-700 hover:bg-blue-900/70 transition-colors duration-200">
                    Create Product
                </button>
            </div>
        </form>
    </div>

    <script>
        function handleImage(input) {
            const preview = document.getElementById('preview');
            const svg = input.parentElement.parentElement.previousElementSibling.previousElementSibling;

            if (input.files && input.files[0]) {
                const reader = new FileReader();

                reader.onload = function(e) {
                    preview.src = e.target.result;
                    preview.classList.remove('hidden');
                    svg.classList.add('hidden');
                }

                reader.readAsDataURL(input.files[0]);
            }
        }

        function dragOverHandler(event) {
            event.preventDefault();
            event.currentTarget.classList.add('border-blue-400');
        }

        function dropHandler(event) {
            event.preventDefault();
            event.currentTarget.classList.remove('border-blue-400');

            const file = event.dataTransfer.files[0];
            if (file && file.type.startsWith('image/')) {
                const input = document.getElementById('image');
                input.files = event.dataTransfer.files;
                handleImage(input);
            }
        }
    </script>
</x-app-layout>