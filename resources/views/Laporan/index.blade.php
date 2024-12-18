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
                                <th class="px-4 py-2 text-left text-sm font-semibold text-gray-800">Tanggal</th>
                                {{-- <th class="px-4 py-2 text-left text-sm font-semibold text-gray-800">End Date</th>
                                <th class="px-4 py-2 text-left text-sm font-semibold text-gray-800">Tanggal</th> --}}
                                <th class="px-4 py-2 text-left text-sm font-semibold text-gray-800">Aksi</th>
                            </tr>
                        </thead>
                            <tbody>
                                @foreach ($laporans as $laporan)
                                    <tr class="border-b">
                                        <td class="px-4 py-2 text-gray-700">{{ $laporan->title }}</td>
                                        <td class="px-4 py-2 text-gray-700">{{ $laporan->author }}</td>
                                        <td class="px-4 py-2 text-gray-700">{{ $laporan->report_date }}</td>
                                        <td class="px-4 py-2">
                                            <button class="px-2 py-1 text-white bg-blue-500 rounded hover:bg-blue-600">Unduh PDF</button>
                                            <button class="px-2 py-1 text-white bg-blue-500 rounded hover:bg-blue-600">Unduh Excel</button>
                                            <button class="px-2 py-1 text-white bg-blue-500 rounded hover:bg-blue-600">Bagikan</button>
                                        </td>
                                    </tr>
                                @endforeach
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
                    <form method="POST" action="{{ route('Laporan.store') }}">
                        @csrf
                        <div class="mb-4">
                            <label for="author" class="block mb-2 text-sm font-medium text-gray-700">Nama Pembuat</label>
                            <input type="text" id="author" name="author"
                                class="w-full p-2 border border-gray-300 rounded focus:ring-blue-500 focus:border-blue-500"
                                placeholder="Masukkan nama pembuat" required>
                        </div>

                        <div class="mb-4">
                            <label for="report-date" class="block mb-2 text-sm font-medium text-gray-700">Tanggal</label>
                            <input type="date" id="report-date" name="report_date"
                                class="w-full p-2 border border-gray-300 rounded focus:ring-blue-500 focus:border-blue-500"
                                required>
                        </div>

                        <div class="mb-4">
                            <label for="title" class="block mb-2 text-sm font-medium text-gray-700">Judul Laporan</label>
                            <input type="text" id="title" name="title"
                                class="w-full p-2 border border-gray-300 rounded focus:ring-blue-500 focus:border-blue-500"
                                placeholder="Masukkan judul laporan" required>
                        </div>

                        <div class="mb-4">
                            <label for="description" class="block mb-2 text-sm font-medium text-gray-700">Isi Laporan</label>
                            <textarea id="description" name="description" rows="6"
                                class="w-full p-2 border border-gray-300 rounded focus:ring-blue-500 focus:border-blue-500"
                                placeholder="Masukkan isi laporan" required></textarea>
                        </div>

                        <button type="submit"
                            class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-300">
                            Submit
                        </button>
                    </form>
                </div>
            </section>
</x-app-layout/div>
    </div>
</x-app-layout>
