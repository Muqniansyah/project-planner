<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800 leading-tight">
            Edit Proyek
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <section class="bg-white shadow-md rounded-lg mb-6">
                <header class="bg-blue-600 text-white p-4 rounded-t-lg">
                    <h5 class="text-lg font-semibold">Edit Proyek</h5>
                </header>
                <div class="p-4">
                    <form action="{{ route('proyek.update', $project->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        
                        <label for="name" class="block mb-2 text-sm font-medium text-gray-700">Judul Proyek</label>
                        <input type="text" id="name" name="name" 
                            value="{{ $project->name }}"
                            class="w-full p-2 border border-gray-300 rounded focus:ring-blue-500 focus:border-blue-500" required>

                        <label for="description" class="block mt-4 mb-2 text-sm font-medium text-gray-700">Deskripsi</label>
                        <textarea id="description" name="description" rows="6"
                            class="w-full p-2 border border-gray-300 rounded focus:ring-blue-500 focus:border-blue-500" required>{{ $project->description }}</textarea>

                        <label for="anggaran" class="block mt-4 mb-2 text-sm font-medium text-gray-700">Anggaran</label>
                        <input type="number" id="anggaran" name="anggaran" 
                            value="{{ $project->anggaran }}"
                            class="w-full p-2 border border-gray-300 rounded focus:ring-blue-500 focus:border-blue-500" required>

                        <button type="submit" 
                            class="w-full mt-4 px-4 py-2 text-white bg-blue-600 rounded hover:bg-blue-700">
                            Simpan Perubahan
                        </button>
                    </form>
                </div>
            </section>
        </div>
    </div>
</x-app-layout>