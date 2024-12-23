<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Profile Information') }}
        </h2>
        <p class="mt-1 text-sm text-gray-600">
            {{ __("Update your account's profile information, profile picture, and email address.") }}
        </p>
    </header>

    <!-- Form untuk mengirim ulang email verifikasi -->
    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <!-- Form untuk memperbarui profil -->
    <form method="post" action="{{ route('profile.update') }}" enctype="multipart/form-data" class="mt-6 space-y-6">
        @csrf
        @method('patch')

        <!-- Input untuk Foto Profil -->
        <div>
            <x-input-label for="profile_picture" :value="__('Profile Picture')" />
            <input type="file" id="profile_picture" name="photo" accept="image/*"
                class="w-full p-2 border border-gray-300 rounded focus:ring-blue-500 focus:border-blue-500"
                onchange="previewProfilePicture(event)">
            <x-input-error class="mt-2" :messages="$errors->get('photo')" />

            <!-- Pratinjau Foto Profil -->
            <div class="mt-4">
                <img id="profile_picture_preview" src="{{ $user->photo == null ? asset('images/user/default.png') : asset('storage/' . $user->photo) }}" alt="Profile Picture Preview"
                    class="object-cover w-32 h-32 border rounded-full">
            </div>
        </div>

        <!-- Input untuk nama -->
        <div>
            <x-input-label for="name" :value="__('Name')" />
            <input type="text" id="name" name="name"
                class="w-full p-2 border border-gray-300 rounded focus:ring-blue-500 focus:border-blue-500" required
                value="{{ old('name', $user->name) }}">
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>

        <!-- Input untuk email -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <input type="text" id="email" name="email"
                class="w-full p-2 border border-gray-300 rounded focus:ring-blue-500 focus:border-blue-500" required
                value="{{ old('email', $user->email) }}">
            <x-input-error class="mt-2" :messages="$errors->get('email')" />

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && !$user->hasVerifiedEmail())
                <div>
                    <p class="mt-2 text-sm text-gray-800">
                        {{ __('Your email address is unverified.') }}
                        <button form="send-verification"
                            class="text-sm text-gray-600 underline rounded-md hover:text-gray-900 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            {{ __('Click here to re-send the verification email.') }}
                        </button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 text-sm font-medium text-green-600">
                            {{ __('A new verification link has been sent to your email address.') }}
                        </p>
                    @endif
                </div>
            @endif
        </div>

        <!-- Input untuk Role -->
        <div>
            <label for="role" class="block text-sm font-medium text-gray-700">Role:</label>
            <select id="role" name="role"
                class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                disabled>
                <option value="karyawan" {{ old('role', $user->role) === 'karyawan' ? 'selected' : '' }}>Karyawan
                </option>
                <option value="manager" {{ old('role', $user->role) === 'manager' ? 'selected' : '' }}>Manager</option>
                <option value="admin" {{ old('role', $user->role) === 'admin' ? 'selected' : '' }}>Admin</option>
            </select>
        </div>

        <!-- Informasi Tanggal Bergabung -->
        <div>
            <p class="text-sm text-gray-700">Bergabung sejak: <strong>2024-01-15</strong></p>
        </div>



        <!-- Tombol Simpan dan Pesan Status -->
        <div class="flex items-center gap-4">
            <button type="submit" class="px-4 py-2 text-white bg-blue-600 rounded hover:bg-blue-700">
                Save
            </button>

            @if (session('status') === 'profile-updated')
                <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600">
                    {{ __('Saved.') }}
                </p>
            @endif
        </div>
    </form>


    <script>
        function previewProfilePicture(event) {
            const reader = new FileReader();
            reader.onload = function() {
                const preview = document.getElementById('profile_picture_preview');
                preview.src = reader.result;
            }
            reader.readAsDataURL(event.target.files[0]);
        }
    </script>
