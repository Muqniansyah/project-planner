<x-app-layout>
    <x-slot name="title">
        Perencanaan Proyek
    </x-slot>

    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800 leading-tight">
            Modul Perencanaan Proyek
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Form Membuat Proyek Baru -->
            <section class="bg-white shadow-md rounded-lg mb-6">
                <header class="bg-blue-600 text-white p-4 rounded-t-lg">
                    <h5 class="text-lg font-semibold">Buat Proyek Baru</h5>
                </header>
                <div class="p-4">
                    <form action="{{ route('proyek.store') }}" method="POST">
                        @csrf
                        <label for="project-title" class="block mb-2 text-sm font-medium text-gray-700">Judul Proyek</label>
                        <input type="text" id="project-title" name="name" 
                            class="w-full p-2 border border-gray-300 rounded focus:ring-blue-500 focus:border-blue-500"
                            placeholder="Masukkan judul proyek" required>

                        <label for="project-desc" class="block mt-4 mb-2 text-sm font-medium text-gray-700">Deskripsi</label>
                        <textarea id="project-desc" name="description" rows="6"
                                class="w-full p-2 border border-gray-300 rounded focus:ring-blue-500 focus:border-blue-500"
                                placeholder="Masukkan deskripsi proyek" required></textarea>

                        <label for="project-budget" class="block mt-4 mb-2 text-sm font-medium text-gray-700">Anggaran</label>
                        <input type="number" id="project-budget" name="anggaran" 
                            class="w-full p-2 border border-gray-300 rounded focus:ring-blue-500 focus:border-blue-500"
                            placeholder="Masukkan anggaran" required>

                        <button type="submit" class="w-full mt-4 px-4 py-2 text-white bg-blue-600 rounded hover:bg-blue-700">Buat Proyek</button>
                    </form>
                </div>
            </section>
        </div>
    </div>
</x-app-layout>
