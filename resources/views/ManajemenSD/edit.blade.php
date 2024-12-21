<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            Edit Sumber Daya
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <section class="mb-6 bg-white rounded-lg shadow-md">
                <header class="flex items-center justify-between p-4 text-white bg-blue-600 rounded-t-lg">
                    <h5 class="text-lg font-semibold">Edit Sumber Daya</h5>
                    <a href="{{ route('ManajemenSD.index') }}" class="flex items-center text-white hover:text-gray-200">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                        </svg>
                        Back
                    </a>
                </header>
                <div class="p-4">
                    <form action="{{ route('ManajemenSD.update', $resource->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        
                        <label for="name" class="block mb-2 text-sm font-medium text-gray-700">Nama Sumber Daya</label>
                        <input type="text" id="name" name="name" 
                            value="{{ $resource->name }}"
                            class="w-full p-2 border border-gray-300 rounded focus:ring-blue-500 focus:border-blue-500" required>

                        <label for="type" class="block mt-4 mb-2 text-sm font-medium text-gray-700">Jenis</label>
                        <select id="type" name="type" 
                            class="w-full p-2 border border-gray-300 rounded focus:ring-blue-500 focus:border-blue-500" required>
                            <option value="">Pilih Jenis</option>
                            <option value="Tenaga Kerja" {{ $resource->type == 'Tenaga Kerja' ? 'selected' : '' }}>Tenaga Kerja</option>
                            <option value="Material" {{ $resource->type == 'Material' ? 'selected' : '' }}>Material</option>
                        </select>

                        <label for="quantity" class="block mt-4 mb-2 text-sm font-medium text-gray-700">Kuantitas</label>
                        <input type="number" id="quantity" name="quantity" 
                            value="{{ $resource->quantity }}"
                            class="w-full p-2 border border-gray-300 rounded focus:ring-blue-500 focus:border-blue-500" required>

                        <button type="submit" 
                            class="w-full px-4 py-2 mt-4 text-white bg-blue-600 rounded hover:bg-blue-700">
                            Simpan Perubahan
                        </button>
                    </form>
                </div>
            </section>
        </div>
    </div>
</x-app-layout>
