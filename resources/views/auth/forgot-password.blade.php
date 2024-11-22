<x-guest-layout>
    
        {{-- Background Gradasi Biru --}}
        <div class="absolute inset-0 bg-gradient-to-br 
            from-blue-100/50 
            via-blue-200/30 
            to-blue-300/50 
            animate-gradient-x"></div>

        {{-- Overlay Putih Transparan --}}
        <div class="absolute inset-0 bg-white bg-opacity-40 backdrop-blur-sm"></div>

        {{-- Container Forgot Password --}}
        <div class="relative z-10 w-full max-w-md">
            <div class="bg-white bg-opacity-20 
                backdrop-blur-lg 
                rounded-2xl 
                shadow-2xl 
                border 
                border-white 
                border-opacity-30 
                p-8 
                space-y-6">
                
                {{-- Header --}}
                <div class="text-center">
                    <div class="flex justify-center mb-4">
                        {{-- Ikon Kunci --}}
                        <div class="w-16 h-16 bg-blue-500/30 rounded-full flex items-center justify-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                            </svg>
                        </div>
                    </div>

                    <h1 class="text-3xl font-bold text-blue-900 mb-2">
                        Reset Password
                    </h1>
                    <p class="text-blue-800 text-opacity-70 text-sm">
                        Enter your email to reset your password
                    </p>
                </div>

                {{-- Session Status --}}
                @if (session('status'))
                    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                        <span class="block sm:inline">{{ session('status') }}</span>
                    </div>
                @endif

                {{-- Form Forgot Password --}}
                <form method="POST" action="{{ route('password.email') }}" class="space-y-5">
                    @csrf

                    {{-- Email Input --}}
                    <div>
                        <label for="email" class="block text-sm font-medium text-blue-900 mb-2">
                            Email Address
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg class="h-5 w-5 text-blue-500" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z" />
                                    <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z" />
                                </svg>
                            </div>
                            <input 
                                type="email" 
                                name="email" 
                                id="email" 
                                required
                                value="{{ old('email') }}"
                                class="w-full pl-10 pr-4 py-3 
                                    bg-blue-100 bg-opacity-30 
                                    border border-blue-300 border-opacity-50 
                                    rounded-lg 
                                    text-blue-900
                                    focus:outline-none 
                                    focus:ring-2 
                                    focus:ring-blue-500 
                                    focus:border-transparent 
                                    transition duration-300"
                                placeholder="Enter your email"
                            >
                        </div>
                        @error('email')
                            <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- Reset Password Button --}}
                    <button 
                        type="submit" 
                        class="w-full py-3 
                            bg-blue-600 
                            text-white 
                            rounded-lg 
                            hover:bg-blue-700 
                            transition duration-300 
                            ease-in-out 
                            transform 
                            hover:scale-105 
                            focus:outline-none 
                            focus:ring-2 
                            focus:ring-blue-500 
                            focus:ring-opacity-50"
                    >
                        Send Password Reset Link
                    </button>

                    {{-- Back to Login --}}
                    <div class="text-center mt-4">
                        <a 
                            href="{{ route('login') }}" 
                            class="text-sm text-blue-700 hover:text-blue-900 
                            flex items-center justify-center 
                            hover:underline"
                        >
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"/>
                        </svg>
                            Back to Login
                        </a>
                    </div>
                </form>
            </div>

            {{-- Dekorasi Tambahan --}}
            <div class="absolute -top-10 -right-10 w-32 h-32 bg-blue-300 opacity-20 rounded-full mix-blend-multiply filter blur-xl"></div>
            <div class="absolute -bottom-10 -left-10 w-32 h-32 bg-purple-300 opacity-20 rounded-full mix-blend-multiply filter blur-xl"></div>
        </div>
    </div>

    {{-- Animasi Gradient Optional --}}
    <style>
        @keyframes gradient-x {
            0%, 100% {
                background-position: 0% 50%;
            }
            50% {
                background-position: 100% 50%;
            }
        }

        .animate-gradient-x {
            background-size: 200% 200%;
            animation: gradient-x 15s ease infinite;
        }
    </style>
</x-guest-layout>