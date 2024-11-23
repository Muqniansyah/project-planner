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
                    Update your password
                </p>
            </div>

            <form method="POST" action="{{ route('password.store') }}" class="space-y-4">
                @csrf
                
                <input type="hidden" name="token" value="{{ $request->route('token') }}">
            
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
                        value="{{ old('email', $request->email) }}"
                        class="w-full px-4 py-2 transition duration-300 bg-white bg-opacity-50 border border-white rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                        placeholder="Enter your email"
                        autocomplete="username"
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
                        placeholder="Create a strong password"
                        autocomplete="new-password"
                    >
                    @error('password')
                        <span class="mt-1 text-xs text-red-500">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Confirm Password Input -->
                <div>
                    <label for="password_confirmation" class="block mb-1 text-sm font-medium text-gray-700">
                        Confirm Password
                    </label>
                    <input 
                        type="password" 
                        name="password_confirmation" 
                        id="password_confirmation" 
                        required
                        class="w-full px-4 py-2 transition duration-300 bg-white bg-opacity-50 border border-white rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                        placeholder="Confirm your password"
                    >
                </div>

                <!-- Password Strength Indicator (Optional) -->
                <div id="password-strength" class="w-full h-1 mt-2 bg-gray-200 rounded-full">
                    <div id="password-strength-meter" class="h-full transition-all duration-300 rounded-full"></div>
                </div>

                <!-- Register Button -->
                <button 
                    type="submit" 
                    class="w-full py-3 text-white transition duration-300 ease-in-out transform bg-blue-500 rounded-lg hover:bg-blue-600 hover:scale-105 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50"
                >
                    Update Password
                </button>

        <!-- Decorative Elements -->
        <div class="absolute top-0 left-0 w-40 h-40 bg-blue-200 rounded-full opacity-30 mix-blend-multiply filter blur-xl animate-blob"></div>
        <div class="absolute bottom-0 right-0 w-40 h-40 bg-purple-200 rounded-full opacity-30 mix-blend-multiply filter blur-xl animate-blob animation-delay-4000"></div>
    </div>

    <!-- Password Strength Script -->
    <script>
        document.getElementById('password').addEventListener('input', function() {
            const password = this.value;
            const strengthMeter = document.getElementById('password-strength-meter');
            
            // Simple strength calculation
            let strength = 0;
            if (password.length > 7) strength++;
            if (password.match(/[a-z]+/)) strength++;
            if (password.match(/[A-Z]+/)) strength++;
            if (password.match(/[0-9]+/)) strength++;
            if (password.match(/[$@#&!]+/)) strength++;

            // Update strength meter
            strengthMeter.classList.remove('bg-red-500', 'bg-yellow-500', 'bg-green-500');
            
            switch(strength) {
                case 0:
                case 1:
                    strengthMeter.classList.add('bg-red-500');
                    strengthMeter.style.width = '20%';
                    break;
                case 2:
                case 3:
                    strengthMeter.classList.add('bg-yellow-500');
                    strengthMeter.style.width = '50%';
                    break;
                case 4:
                case 5:
                    strengthMeter.classList.add('bg-green-500');
                    strengthMeter.style.width = '100%';
                    break;
            }
        });
    </script>

    <!-- Blob Animation Styles -->
    <style>
        @keyframes blob {
            0% { transform: translate(0px, 0px) scale(1); }
            33% { transform: translate(30px, -50px) scale(1.1); }
            66% { transform: translate(-20px, 20px) scale(0.9); }
            100% { transform: translate(0px, 0px) scale(1); }
        }
        .animate-blob {
            animation: blob 7s infinite;
        }
        .animation-delay-4000 {
            animation-delay: 4s;
        }
    </style>
</x-guest-layout>