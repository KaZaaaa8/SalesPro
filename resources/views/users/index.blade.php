<x-app-layout>
    <div class="max-w-7xl mx-auto">
        <div class="mb-6">
            <div class="flex justify-between items-center">
                <h1 class="text-2xl font-bold text-white">Kelola Pengguna</h1>
                <a href="{{ route('users.create') }}" 
                   class="flex items-center px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
                    <i class="fas fa-plus mr-2"></i>
                    <span>Tambah Pengguna</span>
                </a>
            </div>
        </div>

        <div class="bg-dark-secondary rounded-xl border border-gray-700">
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead>
                        <tr class="text-left border-b border-gray-700">
                            <th class="p-4 text-gray-400">Nama</th>
                            <th class="p-4 text-gray-400">Email</th>
                            <th class="p-4 text-gray-400">Role</th>
                            <th class="p-4 text-gray-400">Terdaftar</th>
                            <th class="p-4 text-gray-400">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($users as $user)
                            <tr class="border-b border-gray-700">
                                <td class="p-4 text-gray-300">{{ $user->name }}</td>
                                <td class="p-4 text-gray-300">{{ $user->email }}</td>
                                <td class="p-4">
                                    <span class="px-2 py-1 text-xs rounded-full 
                                        {{ $user->role === 'admin' ? 'bg-blue-900/50 text-blue-400 border border-blue-700' : 'bg-gray-900/50 text-gray-400 border border-gray-700' }}">
                                        {{ ucfirst($user->role) }}
                                    </span>
                                </td>
                                <td class="p-4 text-gray-300">{{ $user->created_at->format('d/m/Y') }}</td>
                                <td class="p-4">
                                    <div class="flex gap-2">
                                        <a href="{{ route('users.edit', $user) }}" 
                                           class="p-2 text-gray-400 hover:text-white">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('users.destroy', $user) }}" 
                                              method="POST" 
                                              onsubmit="return confirm('Apakah Anda yakin ingin menghapus pengguna ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="p-2 text-red-400 hover:text-red-300">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="p-4 text-center text-gray-500">
                                    Tidak ada data pengguna
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="p-4 border-t border-gray-700">
                {{ $users->links() }}
            </div>
        </div>
    </div>
</x-app-layout>
