<x-app-layout>
    <x-slot name="title">
        Perencanaan Proyek
    </x-slot>

    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            Modul Perencanaan Proyek
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <!-- Form Membuat Proyek Baru -->
            <section class="mb-6 bg-white rounded-lg shadow-md">
                <header class="p-4 text-white bg-blue-600 rounded-t-lg">
                    <h5 class="text-lg font-semibold">Buat Proyek Baru</h5>
                </header>
                <div class="p-4">
                    <form action="{{ route('proyek.store') }}" method="POST">
                        @csrf

                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        
                        <label for="project-title" class="block mb-2 text-sm font-medium text-gray-700">Judul
                            Proyek</label>
                        <input type="text" id="project-title" name="name"
                            class="w-full p-2 border border-gray-300 rounded focus:ring-blue-500 focus:border-blue-500"
                            placeholder="Masukkan judul proyek" required>


                        <label for="project-desc"
                            class="block mt-4 mb-2 text-sm font-medium text-gray-700">Deskripsi</label>
                        <textarea id="project-desc" name="description" rows="6"
                            class="w-full p-2 border border-gray-300 rounded focus:ring-blue-500 focus:border-blue-500"
                            placeholder="Masukkan deskripsi proyek" required></textarea>

                        <label for="project-start-date" class="block mb-2 text-sm font-medium text-gray-700">Start
                            Date</label>
                        <input type="date" id="project-start-date" name="start_date"
                            class="w-full p-2 border border-gray-300 rounded focus:ring-blue-500 focus:border-blue-500"
                            required>

                        <label for="project-end-date" class="block mb-2 text-sm font-medium text-gray-700">End
                            Date</label>
                        <input type="date" id="project-end-date" name="end_date"
                            class="w-full p-2 border border-gray-300 rounded focus:ring-blue-500 focus:border-blue-500"
                            required>

                        <label for="project-budget"
                            class="block mt-4 mb-2 text-sm font-medium text-gray-700">Anggaran</label>
                        <input type="number" id="project-budget" name="anggaran"
                            class="w-full p-2 border border-gray-300 rounded focus:ring-blue-500 focus:border-blue-500"
                            placeholder="Masukkan anggaran" required>

                        <button type="submit"
                            class="w-full px-4 py-2 mt-4 text-white bg-blue-600 rounded hover:bg-blue-700">Buat
                            Proyek</button>
                    </form>
                </div>
            </section>
        </div>
    </div>

    <script>
        const startDateInput = document.getElementById('project-start-date');
        const endDateInput = document.getElementById('project-end-date');

        // Event listener untuk start_date
        startDateInput.addEventListener('change', () => {
            // Dapatkan nilai start_date
            const startDate = startDateInput.value;

            // Atur atribut min untuk end_date
            endDateInput.min = startDate;

            // Reset nilai end_date jika sebelumnya tidak valid
            if (endDateInput.value && endDateInput.value < startDate) {
                endDateInput.value = '';
            }
        });
    </script>

</x-app-layout>
