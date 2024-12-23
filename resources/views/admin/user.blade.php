<x-app-layout>

    @if (session('success'))
        <div class="p-4 mb-4 text-green-700 bg-green-100 rounded">
            {{ session('success') }}
        </div>
    @endif

    @if ($errors->any())
        <div class="p-4 mb-4 text-red-700 bg-red-100 rounded">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
        <!-- Resource Table -->
        <section class="mb-6 bg-white rounded-lg shadow-md">
            <header class="flex items-center justify-between p-4 text-white bg-blue-600 rounded-t-lg">
                <h5 class="text-lg font-semibold">User</h5>
                <button class="px-4 py-2 text-white bg-green-600 rounded hover:bg-green-700" onclick="toggleModal(true)">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd"
                            d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z"
                            clip-rule="evenodd" />
                    </svg>
                </button>
            </header>
            <div class="p-4">
                <table class="min-w-full border border-gray-200 rounded-lg table-auto">
                    <thead>
                        <tr class="bg-blue-100">
                            <th class="px-4 py-2 text-sm font-semibold text-left text-gray-800">Nama Lengkap</th>
                            <th class="px-4 py-2 text-sm font-semibold text-left text-gray-800">Email</th>
                            <th class="px-4 py-2 text-sm font-semibold text-left text-gray-800">Role</th>
                            <th class="px-4 py-2 text-sm font-semibold text-left text-gray-800">Jobdesk</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($user as $data)
                            <tr class="border-b">
                                <td class="px-4 py-2 text-gray-700">{{ $data->name }}</td>
                                <td class="px-4 py-2 text-gray-700">{{ $data->email }}</td>
                                <td class="px-4 py-2 text-gray-700">{{ $data->role }}</td>
                                <td class="px-4 py-2 text-gray-700">{{ $data->jobdesk }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </section>
        <!-- Pagination -->
        <div class="flex justify-center mt-4 mb-4">
            {{ $user->appends(request()->query())->links() }}
        </div>

        <div id="modal" class="fixed inset-0 flex items-center justify-center hidden bg-gray-900 bg-opacity-50">
            <div class="bg-white rounded-lg shadow-lg w-96">
                <header class="flex items-center justify-between p-4 text-white bg-blue-600 rounded-t-lg">
                    <h5 class="text-lg font-semibold">Tambah Sumber Daya</h5>
                    <button onclick="toggleModal(false)" class="text-white">&times;</button>
                </header>
                <div class="p-4">
                    <form action="{{ route('admin.user.store') }}" method="POST">
                        @csrf
                        <!-- Nama Lengkap-->
                        <div class="mb-4">
                            <label for="name" class="block mb-2 text-sm font-medium text-gray-700">
                                Nama Lengkap :
                            </label>
                            <input type="text" id="name" name="name"
                                class="w-full p-2 border border-gray-300 rounded focus:ring-blue-500 focus:border-blue-500"
                                required>
                        </div>

                        <!-- Email -->
                        <div class="mb-4">
                            <label for="email" class="block mb-2 text-sm font-medium text-gray-700">
                                Email :
                            </label>
                            <input type="text" id="email" name="email"
                                class="w-full p-2 border border-gray-300 rounded focus:ring-blue-500 focus:border-blue-500"
                                required>
                        </div>

                        <!-- Role -->
                        <div class="mb-4">
                            <label for="role" class="block mb-2 text-sm font-medium text-gray-700">
                                Role :
                            </label>
                            <select id="role" name="role"
                                class="w-full p-2 border border-gray-300 rounded focus:ring-blue-500 focus:border-blue-500"
                                required>
                                <option value="">Pilih Role</option>
                                <option value="admin">Admin</option>
                                <option value="manager">Manager</option>
                                <option value="karyawan">Karyawan</option>
                            </select>
                        </div>

                        <!-- Job Desk -->
                        <div class="mb-4">
                            <label for="jobdesk" class="block mb-2 text-sm font-medium text-gray-700">
                                Job Desk :
                            </label>
                            <select id="jobdesk" name="jobdesk"
                                class="w-full p-2 border border-gray-300 rounded focus:ring-blue-500 focus:border-blue-500"
                                required>
                                <option value="">Pilih Role</option>
                                @foreach ($jobdesk as $data)
                                    <option value="{{ $data->id }}">{{ $data->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Tombol -->
                        <button type="submit"
                            class="w-full px-4 py-2 text-white bg-green-600 rounded hover:bg-green-700">
                            Tambah
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        function toggleModal(show) {
            const modal = document.getElementById('modal');
            modal.classList.toggle('hidden', !show);
        }
    </script>
</x-app-layout>
