<x-guest-layout>
    <div class="container mx-auto p-6">
        <h1 class="text-4xl font-bold text-center mb-8 text-gray-800">Perencanaan Proyek</h1>

        <form id="project-form" class="space-y-6 bg-white p-6 rounded-lg shadow-lg">
            <div class="form-group">
                <label for="title" class="block text-lg font-medium text-gray-700">Judul Proyek</label>
                <input type="text" id="title" placeholder="Masukkan judul proyek" required class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>

            <div class="form-group">
                <label for="description" class="block text-lg font-medium text-gray-700">Deskripsi</label>
                <textarea id="description" placeholder="Masukkan deskripsi proyek" required class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"></textarea>
            </div>

            <div class="form-group">
                <label for="budget" class="block text-lg font-medium text-gray-700">Anggaran</label>
                <input type="number" id="budget" placeholder="Masukkan anggaran" required class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>

            <div class="form-group">
                <label for="resource" class="block text-lg font-medium text-gray-700">Pilih Sumber Daya</label>
                <select id="resource" required class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <option value="">Pilih Sumber Daya</option>
                    <option value="Resource 1">Resource 1</option>
                    <option value="Resource 2">Resource 2</option>
                    <option value="Resource 3">Resource 3</option>
                </select>
            </div>

            <div class="form-group">
                <label for="start-date" class="block text-lg font-medium text-gray-700">Tanggal Mulai</label>
                <input type="date" id="start-date" required class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>

            <div class="form-group">
                <label for="end-date" class="block text-lg font-medium text-gray-700">Tanggal Selesai</label>
                <input type="date" id="end-date" required class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>

            <div class="form-group">
                <label for="status" class="block text-lg font-medium text-gray-700">Status</label>
                <input type="text" id="status" placeholder="Masukkan status proyek" required class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>

            <div class="form-group">
                <label for="created-by" class="block text-lg font-medium text-gray-700">Dibuat Oleh</label>
                <input type="text" id="created-by" placeholder="Masukkan nama pembuat" required class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>

            <button type="button" class="w-full py-3 bg-blue-600 text-white font-semibold rounded-md shadow-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500" onclick="addProject()">Buat Proyek</button>
        </form>

        <h2 class="text-3xl font-semibold mt-10 text-gray-800">Daftar Proyek</h2>
        <div id="project-list" class="project-list mt-4 space-y-4"></div>
    </div>

    <script src="{{ asset('js/scripts.js') }}"></script>
</x-guest-layout>
