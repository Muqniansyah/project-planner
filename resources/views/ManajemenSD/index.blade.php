<x-app-layout>
    <!-- Slot untuk title halaman -->
    <x-slot name="title">
        Manajemen Sumber Daya
    </x-slot>

    <!-- Header halaman -->
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800 leading-tight">
            Modul Manajemen Sumber Daya
        </h2>
    </x-slot>

    @if (session('success'))
        <div class="p-4 mb-4 text-sm text-green-700 bg-green-100 rounded">
            {{ session('success') }}
        </div>
    @endif

    <!-- Bagian konten utama halaman -->
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Resource Table -->
            <section class="bg-white shadow-md rounded-lg mb-6">
                <header class="bg-blue-600 text-white p-4 rounded-t-lg flex justify-between items-center">
                    <h5 class="text-lg font-semibold">Pemantauan Ketersediaan Sumber Daya</h5>
                    <button 
                        class="px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700"
                        onclick="toggleModal(true)">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd" />
                        </svg>
                    </button>
                </header>
                <div class="p-4">
                    <table class="min-w-full table-auto border border-gray-200 rounded-lg">
                        <thead>
                            <tr class="bg-blue-100">
                                <th class="px-4 py-2 text-left text-sm font-semibold text-gray-800">Nama Sumber Daya</th>
                                <th class="px-4 py-2 text-left text-sm font-semibold text-gray-800">Jenis</th>
                                <th class="px-4 py-2 text-left text-sm font-semibold text-gray-800">Kuantitas</th>
                                <th class="px-4 py-2 text-left text-sm font-semibold text-gray-800">Aksi</th>
                                <th class="px-4 py-2 text-left text-sm font-semibold text-gray-800">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($resources as $resource)
                                <tr class="border-b">
                                    <td class="px-4 py-2 text-gray-700">{{ $resource->name }}</td>
                                    <td class="px-4 py-2 text-gray-700">{{ $resource->type }}</td>
                                    <td class="px-4 py-2 text-gray-700">{{ $resource->quantity }}</td>
                                    <td class="px-4 py-2 flex space-x-2">              
                                        <!-- Edit button -->
                                        <a href="" class="text-yellow-500 hover:text-yellow-600">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                                <path fill-rule="evenodd" d="M12.854 2.146a2 2 0 00-2.828 0l-8 8a2 2 0 00-.477.793l-2 7a1 1 0 001.209 1.209l7-2a2 2 0 00.793-.477l8-8a2 2 0 000-2.828l-2.828-2.828a2 2 0 00-2.828 0l-4.242 4.242a1 1 0 00-.293.707v4h-3V8.707a1 1 0 00-.293-.707L12.854 2.146z" clip-rule="evenodd" />
                                            </svg>
                                        </a>
                                        <!-- Show button -->
                                        <button class="text-blue-500 hover:text-blue-600" onclick="showResourceDetails({{ $resource->id }})">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                                <path fill-rule="evenodd" d="M15.75 13.75l-3.62-3.62a6.5 6.5 0 10-1.13 1.13L13.75 15.75a1 1 0 001.5-1.32l-.5-.5a8 8 0 111.25-1.35z" clip-rule="evenodd" />
                                            </svg>
                                        </button>
                                    </td>
                                    <td class="px-4 py-2 text-gray-700">{{ $resource->status }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </section>

            <!-- Allocation Form -->
            <section class="bg-white shadow-md rounded-lg">
                <header class="bg-blue-600 text-white p-4 rounded-t-lg">
                    <h5 class="text-lg font-semibold">Alokasi Sumber Daya</h5>
                </header>
                <div class="p-4">
                    <form action="" method="POST">
                        @csrf
                        <!-- Pilih Sumber Daya -->
                        <div class="mb-4">
                            <label for="resource_id" class="block mb-2 text-sm font-medium text-gray-700">
                                Sumber Daya:
                            </label>
                            <select id="resource_id" name="resource_id"
                                class="w-full p-2 border border-gray-300 rounded focus:ring-blue-500 focus:border-blue-500"
                                required>
                                <option value="">Pilih Sumber Daya</option>
                                @foreach ($resources as $resource)
                                    <option value="{{ $resource->id }}">{{ $resource->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Pilih Proyek -->
                        <div class="mb-4">
                            <label for="project_id" class="block mb-2 text-sm font-medium text-gray-700">
                                Proyek:
                            </label>
                            <select id="project_id" name="project_id"
                                class="w-full p-2 border border-gray-300 rounded focus:ring-blue-500 focus:border-blue-500"
                                required>
                                <option value="">Pilih Proyek</option>
                            </select>
                        </div>

                        <!-- Kuantitas -->
                        <div class="mb-4">
                            <label for="quantity" class="block mb-2 text-sm font-medium text-gray-700">
                                Kuantitas:
                            </label>
                            <input type="number" id="quantity" name="quantity"
                                class="w-full p-2 border border-gray-300 rounded focus:ring-blue-500 focus:border-blue-500"
                                required>
                        </div>

                        <!-- Tombol -->
                        <button type="submit"
                            class="w-full px-4 py-2 text-white bg-blue-600 rounded hover:bg-blue-700">
                            Alokasikan
                        </button>
                    </form>
                </div>
            </section>
        </div>
    </div>

    <!-- Modal Box -->
    <div id="modal" class="fixed inset-0 bg-gray-900 bg-opacity-50 flex items-center justify-center hidden">
        <div class="bg-white rounded-lg shadow-lg w-96">
            <header class="bg-blue-600 text-white p-4 rounded-t-lg flex justify-between items-center">
                <h5 class="text-lg font-semibold">Detail Sumber Daya</h5>
                <button onclick="toggleModal(false)" class="text-white">&times;</button>
            </header>
            <div class="p-4">
                <div id="modal-content">
                    <!-- This content will be populated dynamically -->
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Toggle Script -->
    <script>
        function toggleModal(show) {
            const modal = document.getElementById('modal');
            modal.classList.toggle('hidden', !show);
        }

        function showResourceDetails(resourceId) {
            // Fetch the resource details from your backend (using AJAX or something like that)
            // This is just an example of how you might display the resource details
            const resource = @json($resources).find(r => r.id === resourceId);
            if (resource) {
                const modalContent = `
                    <div class="mb-4">
                        <p><strong>Nama:</strong> ${resource.name}</p>
                        <p><strong>Jenis:</strong> ${resource.type}</p>
                        <p><strong>Kuantitas:</strong> ${resource.quantity}</p>
                        <p><strong>Status:</strong> ${resource.status}</p>
                    </div>
                `;
                document.getElementById('modal-content').innerHTML = modalContent;
                toggleModal(true);
            }
        }
    </script>
</x-app-layout>
