<x-guest-layout>
    <div class="relative overflow-hidden bg-gradient-to-br from-blue-100 via-transparent to-purple-100">
        <!-- Background Overlay -->
        <div class="absolute inset-0 bg-white bg-opacity-10 backdrop-blur-sm"></div>
        
        <div class="relative w-full max-w-md p-8 space-y-6 bg-white border border-white shadow-xl bg-opacity-20 backdrop-blur-lg rounded-xl border-opacity-20">
            <div class="text-center">
                <h2 class="mb-2 text-3xl font-bold text-gray-800">
                    Project Planner
                </h2>
                <p class="text-sm text-gray-600">
                    Welcome back! Please login to your account
                </p>
            </div>

            <form method="POST" action="{{ route('login') }}" class="space-y-4">
                @csrf

                <!-- Email Input -->
                <div>
                    <label for="email" class="block mb-1 text-sm font-medium text-gray-700">
                        Email Address
                    </label>
                    <input 
                        type="email" 
                        name="email" 
                        id="email" 
                        required
                        class="w-full px-4 py-2 transition duration-300 bg-white bg-opacity-50 border border-white rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                        placeholder="Enter your email"
                    >
                    @error('email')
                        <span class="mt-1 text-xs text-red-500">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Password Input -->
                <div>
                    <label for="password" class="block mb-1 text-sm font-medium text-gray-700">
                        Password
                    </label>
                    <input 
                        type="password" 
                        name="password" 
                        id="password" 
                        required
                        class="w-full px-4 py-2 transition duration-300 bg-white bg-opacity-50 border border-white rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                        placeholder="Enter your password"
                    >
                    @error('password')
                        <span class="mt-1 text-xs text-red-500">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Remember Me & Forgot Password -->
                <div class="flex items-center justify-between">
                    <div class="flex items-center">
                        <input 
                            type="checkbox" 
                            name="remember" 
                            id="remember" 
                            class="w-4 h-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500"
                        >
                        <label for="remember" class="block ml-2 text-sm text-gray-900">
                            Remember me
                        </label>
                    </div>
                    <div>
                        <a href="{{ route('password.request') }}" class="text-sm text-blue-600 hover:text-blue-800">
                            Forgot password?
                        </a>
                    </div>
                </div>

                <!-- Login Button -->
                <button 
                    type="submit" 
                    class="w-full py-3 text-white transition duration-300 ease-in-out transform bg-blue-500 rounded-lg hover:bg-blue-600 hover:scale-105 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50"
                >
                    Login
                </button>

                <!-- Register Link -->
                {{-- <div class="mt-4 text-center">
                    <p class="text-sm text-gray-600">
                        Don't have an account? 
                        <a href="{{ route('register') }}" class="font-semibold text-blue-600 hover:text-blue-800">
                            Register here
                        </a>
                    </p>
                </div> --}}
            </form>
        </div>

        <!-- Decorative Elements -->
        <div class="absolute top-0 left-0 w-40 h-40 bg-blue-200 rounded-full opacity-30 mix-blend-multiply filter blur-xl animate-blob"></div>
        <div class="absolute bottom-0 right-0 w-40 h-40 bg-purple-200 rounded-full opacity-30 mix-blend-multiply filter blur-xl animate-blob animation-delay-4000"></div>
    </div>

    <!-- Optional: Add some custom animations -->
    <style>
        @keyframes blob {
            0% {
                transform: translate(0px, 0px) scale(1);
            }
            33% {
                transform: translate(30px, -50px) scale(1.1);
            }
            66% {
                transform: translate(-20px, 20px) scale(0.9);
            }
            100% {
                transform: translate(0px, 0px) scale(1);
            }
        }
        .animate-blob {
            animation: blob 7s infinite;
        }
        .animation-delay-4000 {
            animation-delay: 4s;
        }
    </style>
</x-guest-layout>