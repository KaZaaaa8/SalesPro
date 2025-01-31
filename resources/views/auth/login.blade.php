<x-guest-layout>
    <div class="w-full max-w-md px-6">
        <!-- Logo or Brand -->
        <div class="text-center mb-8">
            <h1 class="text-3xl font-bold bg-gradient-to-r from-blue-500 to-purple-500 bg-clip-text text-transparent">
                {{ config('app.name') }}
            </h1>
            <p class="mt-2 text-gray-400">Sign in to your account</p>
        </div>

        <!-- Login Card -->
        <div class="bg-[#1E293B] rounded-2xl border border-gray-800 backdrop-blur-xl">
            <div class="p-8">
                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="space-y-6">
                        <!-- Email -->
                        <div>
                            <label class="block text-sm font-medium text-gray-400 mb-2">
                                Email Address
                            </label>
                            <div class="relative">
                                <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-gray-500">
                                    <i class="fas fa-envelope"></i>
                                </span>
                                <input type="email"
                                    name="email"
                                    value="{{ old('email') }}"
                                    class="w-full pl-10 pr-4 py-2.5 bg-[#0F172A] border border-gray-800 rounded-xl text-gray-300 focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500"
                                    placeholder="name@salespro.com"
                                    required>
                            </div>
                            @error('email')
                            <p class="mt-1.5 text-sm text-red-400">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Password -->
                        <div>
                            <label class="block text-sm font-medium text-gray-400 mb-2">
                                Password
                            </label>
                            <div class="relative">
                                <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-gray-500">
                                    <i class="fas fa-lock"></i>
                                </span>
                                <input type="password"
                                    name="password"
                                    class="w-full pl-10 pr-4 py-2.5 bg-[#0F172A] border border-gray-800 rounded-xl text-gray-300 focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500"
                                    placeholder="••••••••"
                                    required>
                            </div>
                            @error('password')
                            <p class="mt-1.5 text-sm text-red-400">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Remember & Forgot -->
                        <div class="flex items-center justify-between">
                            <label class="flex items-center">
                                <input type="checkbox"
                                    name="remember"
                                    class="w-4 h-4 rounded border-gray-800 text-blue-500 focus:ring-blue-500 focus:ring-offset-0 bg-[#0F172A]">
                                <span class="ml-2 text-sm text-gray-400">Remember me</span>
                            </label>

                            @if (Route::has('password.request'))
                            <a href="{{ route('password.request') }}"
                                class="text-sm text-blue-400 hover:text-blue-300 transition-colors">
                                Forgot password?
                            </a>
                            @endif
                        </div>

                        <!-- Submit Button -->
                        <button type="submit"
                            class="w-full py-2.5 px-4 text-sm font-semibold text-white bg-gradient-to-r from-blue-600 to-blue-700 rounded-xl hover:from-blue-500 hover:to-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 focus:ring-offset-[#1E293B] transition-all">
                            Sign in to your account
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Footer Links -->
        <div class="mt-8 text-center text-sm text-gray-400">
            <a href="#" class="hover:text-gray-300 transition-colors">Privacy Policy</a>
            <span class="mx-2">•</span>
            <a href="#" class="hover:text-gray-300 transition-colors">Terms of Service</a>
        </div>
    </div>
</x-guest-layout>