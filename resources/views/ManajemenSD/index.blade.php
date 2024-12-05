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

    <!-- Bagian konten utama halaman -->
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Resource Table -->
            <section class="bg-white shadow-md rounded-lg mb-6">
                <header class="bg-blue-600 text-white p-4 rounded-t-lg">
                    <h5 class="text-lg font-semibold">Pemantauan Ketersediaan Sumber Daya</h5>
                </header>
                <div class="p-4">
                    <table class="min-w-full table-auto border border-gray-200 rounded-lg">
                        <thead>
                            <tr class="bg-blue-100">
                                <th class="px-4 py-2 text-left text-sm font-semibold text-gray-800">Nama Sumber Daya</th>
                                <th class="px-4 py-2 text-left text-sm font-semibold text-gray-800">Jenis</th>
                                <th class="px-4 py-2 text-left text-sm font-semibold text-gray-800">Kuantitas</th>
                                <th class="px-4 py-2 text-left text-sm font-semibold text-gray-800">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="border-b">
                                <td class="px-4 py-2 text-gray-700">Tenaga Kerja A</td>
                                <td class="px-4 py-2 text-gray-700">Tenaga Kerja</td>
                                <td class="px-4 py-2 text-gray-700">10 Orang</td>
                                <td class="px-4 py-2">
                                    <button class="px-2 py-1 text-white bg-yellow-500 rounded hover:bg-yellow-600">
                                        Edit
                                    </button>
                                </td>
                            </tr>
                            <tr>
                                <td class="px-4 py-2 text-gray-700">Material B</td>
                                <td class="px-4 py-2 text-gray-700">Material</td>
                                <td class="px-4 py-2 text-gray-700">50 Unit</td>
                                <td class="px-4 py-2">
                                    <button class="px-2 py-1 text-white bg-yellow-500 rounded hover:bg-yellow-600">
                                        Edit
                                    </button>
                                </td>
                            </tr>
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
                    <form>
                        @csrf
                        <!-- Nama Sumber Daya -->
                        <div class="mb-4">
                            <label for="resourceName" class="block mb-2 text-sm font-medium text-gray-700">
                                Nama Sumber Daya:
                            </label>
                            <input type="text" id="resourceName" name="resource_name"
                                class="w-full p-2 border border-gray-300 rounded focus:ring-blue-500 focus:border-blue-500"
                                required>
                        </div>

                        <!-- Jenis -->
                        <div class="mb-4">
                            <label for="resourceType" class="block mb-2 text-sm font-medium text-gray-700">
                                Jenis:
                            </label>
                            <select id="resourceType" name="resource_type"
                                class="w-full p-2 border border-gray-300 rounded focus:ring-blue-500 focus:border-blue-500"
                                required>
                                <option value="">Pilih Jenis</option>
                                <option value="Tenaga Kerja">Tenaga Kerja</option>
                                <option value="Material">Material</option>
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
</x-app-layout>
