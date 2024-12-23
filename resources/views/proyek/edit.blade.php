@extends('proyek.detail')

@section('content')
    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <section class="mb-6 bg-white rounded-lg shadow-md">
                <header class="p-4 text-white bg-blue-600 rounded-t-lg">
                    <h5 class="text-lg font-semibold">Edit Proyek {{ $project->name }}</h5>
                </header>
                <div class="p-4">
                    <form action="{{ route('proyek.update', $project->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <label for="name" class="block mb-2 text-sm font-medium text-gray-700">Judul Proyek</label>
                        <input type="text" id="name" name="name" value="{{ $project->name }}"
                            class="w-full p-2 border border-gray-300 rounded focus:ring-blue-500 focus:border-blue-500"
                            required>

                        <label for="description" class="block mt-4 mb-2 text-sm font-medium text-gray-700">Deskripsi</label>
                        <textarea id="description" name="description" rows="6"
                            class="w-full p-2 border border-gray-300 rounded focus:ring-blue-500 focus:border-blue-500" required>{{ $project->description }}</textarea>

                        <label for="project-start-date" class="block mb-2 text-sm font-medium text-gray-700">Start
                            Date</label>
                        <input type="date" id="project-start-date" name="start_date"
                            value="{{ $project->start_date->format('Y-m-d') }}"
                            class="w-full p-2 border border-gray-300 rounded focus:ring-blue-500 focus:border-blue-500"
                            required>

                        <label for="project-end-date" class="block mb-2 text-sm font-medium text-gray-700">End Date</label>
                        <input type="date" id="project-end-date" name="end_date"
                            value="{{ $project->end_date->format('Y-m-d') }}"
                            class="w-full p-2 border border-gray-300 rounded focus:ring-blue-500 focus:border-blue-500"
                            required>


                        <label for="anggaran" class="block mt-4 mb-2 text-sm font-medium text-gray-700">Anggaran</label>
                        <input type="number" id="anggaran" name="anggaran" value="{{ $project->anggaran }}"
                            class="w-full p-2 border border-gray-300 rounded focus:ring-blue-500 focus:border-blue-500"
                            required>

                        <button type="submit"
                            class="w-full px-4 py-2 mt-4 text-white bg-blue-600 rounded hover:bg-blue-700">
                            Simpan Perubahan
                        </button>
                    </form>
                </div>
            </section>
        </div>
    </div>
@endsection
