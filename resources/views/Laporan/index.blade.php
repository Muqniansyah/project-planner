<x-app-layout>
    <x-slot name="title">
        Laporan Proyek  {{ $project->name }}
    </x-slot>

    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            Laporan Proyek  {{ $project->name }}
        </h2>
    </x-slot>

    <div class="flex flex-wrap justify-center gap-2 p-4 rounded-md shadow-sm" role="group">
        <button type="button" onclick="window.location='{{ route('proyekdetail.index', $project->id) }}'"
            class="px-4 py-2 text-sm font-medium text-center 
            {{ Route::current()->getName() == 'proyekdetail.index' ? 'rounded-full text-white bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 hover:bg-green-900' : 'text-green-700 border border-green-700 rounded-full hover:text-white hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300' }}">
            Task Project
        </button>
        <button type="button" onclick="window.location='{{ route('ManajemenSD.view', ['id' => $project->id]) }}'"
            class="px-4 py-2 text-sm font-medium text-center 
            {{ Request::is('ManajemenSD*') ? 'rounded-full text-white bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 hover:bg-green-900' : 'text-green-700 border border-green-700 rounded-full hover:text-white hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300' }}">
            Sumber Daya
        </button>
        <button type="button" onclick="window.location='{{ route('Laporan.index', $project->id) }}'"
            class="px-4 py-2 text-sm font-medium text-center 
            {{ Request::is('Laporan*') ? 'rounded-full text-white bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 hover:bg-green-900' : 'text-green-700 border border-green-700 rounded-full hover:text-white hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300' }}">
            Project Report
        </button>
        <button type="button" onclick="window.location='{{ route('proyek.edit', $project->id) }}'"
            class="px-4 py-2 text-sm font-medium text-center 
            {{ Request::is('proyek/edit*') ? 'rounded-full text-white bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 hover:bg-green-900' : 'text-green-700 border border-green-700 rounded-full hover:text-white hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300' }}">
            Settings
        </button>
    </div>

    <!-- Konten Laporan -->
    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <!-- Daftar Laporan -->
            <section class="mb-6 bg-white rounded-lg shadow-md">
                <header class="p-4 text-white bg-blue-600 rounded-t-lg">
                    <h5 class="text-lg font-semibold">Daftar Laporan untuk {{ $project->name }}</h5>
                </header>
                <div class="p-4 overflow-x-auto">
                    <table class="min-w-full border border-gray-200 rounded-lg">
                        <thead>
                            <tr class="bg-blue-100">
                                <th class="px-4 py-2 text-sm font-semibold text-left text-gray-800">Judul Laporan</th>
                                <th class="px-4 py-2 text-sm font-semibold text-left text-gray-800">Dibuat Oleh</th>
                                <th class="px-4 py-2 text-sm font-semibold text-left text-gray-800">Tanggal</th>
                                <th class="px-4 py-2 text-sm font-semibold text-left text-gray-800">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($laporans as $laporan)
                                <tr class="border-b">
                                    <td class="px-4 py-2 text-gray-700">{{ $laporan->title }}</td>
                                    <td class="px-4 py-2 text-gray-700">{{ $laporan->author }}</td>
                                    <td class="px-4 py-2 text-gray-700">{{ $laporan->report_date }}</td>
                                    <td class="px-4 py-2">
                                        <a href="{{ route('Laporan.downloadPDF', $laporan->id) }}" class="px-2 py-1 mr-2 text-white bg-blue-500 rounded hover:bg-blue-600">
                                            Unduh PDF
                                        </a>
                                        <a href="{{ route('Laporan.exportExcel', $laporan->id) }}" class="px-2 py-1 mr-2 text-white bg-green-500 rounded hover:bg-green-600">
                                            Unduh Excel
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </section>
        </div>
    </div>

    <div class="py-1">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <section class="mb-6 bg-white rounded-lg shadow-md mb-2 mt-2">
                <header class="p-4 text-white bg-blue-600 rounded-t-lg">
                    <h5 class="text-lg font-semibold">Tambah Laporan Baru untuk {{ $project->name }}</h5>
                </header>
                <div class="p-4">
                    <form method="POST" action="{{ route('Laporan.store') }}">
                        @csrf
                        <input type="hidden" name="project_id" value="{{ $project->id }}">
    
                        <div class="mb-4">
                            <label for="title" class="block mb-2 text-sm font-medium text-gray-700">Judul Laporan</label>
                            <input type="text" id="title" name="title"
                                class="w-full p-2 border border-gray-300 rounded focus:ring-blue-500 focus:border-blue-500"
                                placeholder="Masukkan judul laporan" required>
                        </div>
    
                        <div class="mb-4">
                            <label for="author" class="block mb-2 text-sm font-medium text-gray-700">Nama Pembuat</label>
                            <input type="text" id="author" name="author"
                                class="w-full p-2 border border-gray-300 rounded focus:ring-blue-500 focus:border-blue-500"
                                placeholder="Masukkan nama pembuat" required>
                        </div>
    
                        <div class="mb-4">
                            <label for="report_date" class="block mb-2 text-sm font-medium text-gray-700">Tanggal</label>
                            <input type="date" id="report_date" name="report_date"
                                class="w-full p-2 border border-gray-300 rounded focus:ring-blue-500 focus:border-blue-500"
                                required>
                        </div>
    
                        <div class="mb-4">
                            <label for="description" class="block mb-2 text-sm font-medium text-gray-700">Isi Laporan</label>
                            <textarea id="description" name="description" rows="4"
                                class="w-full p-2 border border-gray-300 rounded focus:ring-blue-500 focus:border-blue-500"
                                placeholder="Masukkan isi laporan" required></textarea>
                        </div>
    
                        <button type="submit"
                            class="w-full px-4 py-2 text-white bg-blue-600 rounded hover:bg-blue-700">
                            Tambahkan Laporan
                        </button>
                    </form>
                </div>
            </section>
        </div>
    </div>
    
    
    
    



</x-app-layout>
