<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'SalesPro') }}</title>

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    colors: {
                        dark: {
                            'primary': '#1F2937',
                            'secondary': '#111827',
                            'accent': '#3B82F6'
                        }
                    }
                }
            }
        }
    </script>
    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <!-- Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
    </style>
</head>

<body class="font-sans antialiased bg-dark-primary text-gray-200">
    <div class="min-h-screen flex">
        <!-- Sidebar -->
        <aside class="fixed inset-y-0 left-0 bg-dark-secondary w-64 transition-transform duration-300 ease-in-out">
            <div class="flex flex-col h-full">
                <div class="flex items-center justify-center h-16 bg-dark-primary border-b border-gray-700">
                    <h1 class="text-xl font-bold text-white">
                        <i class="fas fa-store-alt mr-2 text-dark-accent"></i>
                        SalesPro
                    </h1>
                </div>

                <nav class="flex-1 px-4 py-6 space-y-2 overflow-y-auto">
                    <a href="{{ route('dashboard') }}"
                        class="flex items-center px-4 py-3 text-gray-300 hover:bg-dark-primary rounded-lg transition-colors duration-200 
                              {{ request()->routeIs('dashboard') ? 'bg-dark-primary text-white' : '' }}">
                        <i class="fas fa-home w-5 h-5"></i>
                        <span class="ml-3">Dashboard</span>
                    </a>

                    <a href="{{ route('products.index') }}"
                        class="flex items-center px-4 py-3 text-gray-300 hover:bg-dark-primary rounded-lg transition-colors duration-200
                              {{ request()->routeIs('products.*') ? 'bg-dark-primary text-white' : '' }}">
                        <i class="fas fa-box w-5 h-5"></i>
                        <span class="ml-3">Products</span>
                    </a>

                    <a href="{{ route('categories.index') }}"
                        class="flex items-center px-4 py-3 text-gray-300 hover:bg-dark-primary rounded-lg transition-colors duration-200
                              {{ request()->routeIs('categories.*') ? 'bg-dark-primary text-white' : '' }}">
                        <i class="fas fa-tags w-5 h-5"></i>
                        <span class="ml-3">Categories</span>
                    </a>

                    <a href="{{ route('transactions.create') }}"
                        class="flex items-center px-4 py-3 text-gray-300 hover:bg-dark-primary rounded-lg transition-colors duration-200
                              {{ request()->routeIs('transactions.create') ? 'bg-dark-primary text-white' : '' }}">
                        <i class="fas fa-cash-register w-5 h-5"></i>
                        <span class="ml-3">New Sale</span>
                    </a>

                    <a href="{{ route('transactions.index') }}"
                        class="flex items-center px-4 py-3 text-gray-300 hover:bg-dark-primary rounded-lg transition-colors duration-200
                              {{ request()->routeIs('transactions.index') ? 'bg-dark-primary text-white' : '' }}">
                        <i class="fas fa-receipt w-5 h-5"></i>
                        <span class="ml-3">Transactions</span>
                    </a>

                    @if(Auth::user()->isAdmin())
                    <a href="{{ route('users.index') }}"
                        class="flex items-center px-4 py-3 text-gray-300 hover:bg-dark-primary rounded-lg transition-colors duration-200
                              {{ request()->routeIs('users.*') ? 'bg-dark-primary text-white' : '' }}">
                        <i class="fas fa-users w-5 h-5"></i>
                        <span class="ml-3">Users</span>
                    </a>
                    @endif
                </nav>

                <div class="p-4 border-t border-gray-700">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center">
                            <img class="h-8 w-8 rounded-full bg-gray-500"
                                src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}"
                                alt="{{ Auth::user()->name }}">
                            <div class="ml-3">
                                <p class="text-sm font-medium text-white">{{ Auth::user()->name }}</p>
                                <p class="text-xs text-gray-400">{{ Auth::user()->role }}</p>
                            </div>
                        </div>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="text-gray-400 hover:text-white transition-colors duration-200">
                                <i class="fas fa-sign-out-alt"></i>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </aside>

        <!-- Main Content -->
        <main class="flex-1 ml-64">
            <!-- Top Navigation -->
            <div class="bg-dark-secondary border-b border-gray-700 h-16 flex items-center justify-between px-6">
                <h2 class="text-xl font-semibold text-white">
                    @yield('header', 'Dashboard')
                </h2>
            </div>

            <!-- Page Content -->
            <div class="p-6">
                @if(session('success'))
                <div class="mb-4 px-4 py-2 bg-green-900/50 border border-green-600 text-green-400 rounded-lg">
                    {{ session('success') }}
                </div>
                @endif

                @if(session('error'))
                <div class="mb-4 px-4 py-2 bg-red-900/50 border border-red-600 text-red-400 rounded-lg">
                    {{ session('error') }}
                </div>
                @endif

                {{ $slot }}
            </div>
        </main>
    </div>
</body>

</html>