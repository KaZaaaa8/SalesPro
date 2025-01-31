<x-app-layout>
    <div class="max-w-2xl mx-auto">
        <div class="mb-6">
            <div class="flex justify-between items-center">
                <h1 class="text-2xl font-bold text-white">Tambah Pengguna</h1>
                <a href="{{ route('users.index') }}" 
                   class="flex items-center px-4 py-2 bg-gray-800 text-gray-300 rounded-lg hover:bg-gray-700">
                    <i class="fas fa-arrow-left mr-2"></i>
                    <span>Kembali</span>
                </a>
            </div>
        </div>

        <div class="bg-dark-secondary rounded-xl border border-gray-700 p-6">
            <form action="{{ route('users.store') }}" method="POST">
                @csrf
                <div class="space-y-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-400 mb-2">
                            Nama Lengkap
                        </label>
                        <input type="text" 
                               name="name" 
                               value="{{ old('name') }}"
                               class="w-full px-4 py-2 bg-dark-primary border border-gray-700 rounded-lg text-gray-300 focus:outline-none focus:border-blue-500"
                               required>
                        @error('name')
                            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-400 mb-2">
                            Email
                        </label>
                        <input type="email" 
                               name="email" 
                               value="{{ old('email') }}"
                               class="w-full px-4 py-2 bg-dark-primary border border-gray-700 rounded-lg text-gray-300 focus:outline-none focus:border-blue-500"
                               required>
                        @error('email')
                            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-400 mb-2">
                            Password
                        </label>
                        <input type="password" 
                               name="password"
                               class="w-full px-4 py-2 bg-dark-primary border border-gray-700 rounded-lg text-gray-300 focus:outline-none focus:border-blue-500"
                               required>
                        @error('password')
                            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-400 mb-2">
                            Konfirmasi Password
                        </label>
                        <input type="password" 
                               name="password_confirmation"
                               class="w-full px-4 py-2 bg-dark-primary border border-gray-700 rounded-lg text-gray-300 focus:outline-none focus:border-blue-500"
                               required>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-400 mb-2">
                            Role
                        </label>
                        <select name="role"
                                class="w-full px-4 py-2 bg-dark-primary border border-gray-700 rounded-lg text-gray-300 focus:outline-none focus:border-blue-500">
                            <option value="cashier" {{ old('role') === 'cashier' ? 'selected' : '' }}>Cashier</option>
                            <option value="admin" {{ old('role') === 'admin' ? 'selected' : '' }}>Admin</option>
                        </select>
                        @error('role')
                            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <button type="submit" 
                            class="w-full px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
                        Simpan Pengguna
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
