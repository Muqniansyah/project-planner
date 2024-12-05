<x-app-layout>
    <x-slot name="title">
        Laporan Proyek
    </x-slot>

    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800 leading-tight">
            Modul Laporan Proyek
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Daftar Laporan -->
            <section class="bg-white shadow-md rounded-lg mb-6">
                <header class="bg-blue-600 text-white p-4 rounded-t-lg">
                    <h5 class="text-lg font-semibold">Daftar Laporan</h5>
                </header>
                <div class="p-4 overflow-x-auto">
                    <table class="min-w-full border border-gray-200 rounded-lg">
                        <thead>
                            <tr class="bg-blue-100">
                                <th class="px-4 py-2 text-left text-sm font-semibold text-gray-800">Judul Laporan</th>
                                <th class="px-4 py-2 text-left text-sm font-semibold text-gray-800">Dibuat Oleh</th>
                                <th class="px-4 py-2 text-left text-sm font-semibold text-gray-800">Start Date</th>
                                <th class="px-4 py-2 text-left text-sm font-semibold text-gray-800">End Date</th>
                                <th class="px-4 py-2 text-left text-sm font-semibold text-gray-800">Tanggal</th>
                                <th class="px-4 py-2 text-left text-sm font-semibold text-gray-800">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="border-b">
                                <td class="px-4 py-2 text-gray-700">Laporan Perencanaan A</td>
                                <td class="px-4 py-2 text-gray-700">Anwar</td>
                                <td class="px-4 py-2 text-gray-700">2024-11-01</td>
                                <td class="px-4 py-2 text-gray-700">2024-11-20</td>
                                <td class="px-4 py-2 text-gray-700">2024-11-20</td>
                                <td class="px-4 py-2">
                                    <button class="px-2 py-1 text-white bg-blue-500 rounded hover:bg-blue-600">Unduh PDF</button>
                                    <button class="px-2 py-1 text-white bg-blue-500 rounded hover:bg-blue-600">Unduh Excel</button>
                                    <button class="px-2 py-1 text-white bg-blue-500 rounded hover:bg-blue-600">Bagikan</button>
                                </td>
                            </tr>
                            <tr>
                                <td class="px-4 py-2 text-gray-700">Laporan Progress B</td>
                                <td class="px-4 py-2 text-gray-700">Budi</td>
                                <td class="px-4 py-2 text-gray-700">2024-10-01</td>
                                <td class="px-4 py-2 text-gray-700">2024-11-15</td>
                                <td class="px-4 py-2 text-gray-700">2024-11-15</td>
                                <td class="px-4 py-2">
                                    <button class="px-2 py-1 text-white bg-blue-500 rounded hover:bg-blue-600">Unduh PDF</button>
                                    <button class="px-2 py-1 text-white bg-blue-500 rounded hover:bg-blue-600">Unduh Excel</button>
                                    <button class="px-2 py-1 text-white bg-blue-500 rounded hover:bg-blue-600">Bagikan</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </section>

            <!-- Form Laporan Baru -->
            <section class="bg-white shadow-md rounded-lg">
                <header class="bg-blue-600 text-white p-4 rounded-t-lg">
                    <h5 class="text-lg font-semibold">Buat Laporan Baru</h5>
                </header>
                <div class="p-4">
                    <form>
                        @csrf
                        <div class="mb-4">
                            <label for="report-title" class="block mb-2 text-sm font-medium text-gray-700">Judul Laporan</label>
                            <input type="text" id="report-title"
                                class="w-full p-2 border border-gray-300 rounded focus:ring-blue-500 focus:border-blue-500"
                                placeholder="Masukkan judul laporan" required>
                        </div>
                        <div class="mb-4">
                            <label for="report-content" class="block mb-2 text-sm font-medium text-gray-700">Isi Laporan</label>
                            <textarea id="report-content" rows="6"
                                class="w-full p-2 border border-gray-300 rounded focus:ring-blue-500 focus:border-blue-500"
                                placeholder="Masukkan isi laporan" required></textarea>
                        </div>
                        <div class="mb-4">
                            <label for="start-date" class="block mb-2 text-sm font-medium text-gray-700">Start Date</label>
                            <input type="date" id="start-date"
                                class="w-full p-2 border border-gray-300 rounded focus:ring-blue-500 focus:border-blue-500"
                                required>
                        </div>
                        <div class="mb-4">
                            <label for="end-date" class="block mb-2 text-sm font-medium text-gray-700">End Date</label>
                            <input type="date" id="end-date"
                                class="w-full p-2 border border-gray-300 rounded focus:ring-blue-500 focus:border-blue-500"
                                required>
                        </div>
                        <button type="submit"
                            class="w-full px-4 py-2 text-white bg-blue-600 rounded hover:bg-blue-700">Buat Laporan</button>
                    </form>
                </div>
            </section>
        </div>
    </div>
</x-app-layout>
