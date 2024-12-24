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
            <section class="mb-6 bg-white rounded-lg shadow-md">
                <header class="flex items-center justify-between p-4 text-white bg-blue-600 rounded-t-lg">
                    <h5 class="text-lg font-semibold">Project</h5>
                </header>
                <div class="p-4">
                    <table class="min-w-full border border-gray-200 rounded-lg table-auto">
                        <thead>
                            <tr class="bg-blue-100">
                                <th class="px-4 py-2 text-sm font-semibold text-left text-gray-800">Nama Project
                                </th>
                                <th class="px-4 py-2 text-sm font-semibold text-left text-gray-800">Deskripsi Project
                                </th>
                                <th class="px-4 py-2 text-sm font-semibold text-left text-gray-800">Start Date</th>
                                <th class="px-4 py-2 text-sm font-semibold text-left text-gray-800">End Date</th>
                                <th class="px-4 py-2 text-sm font-semibold text-left text-gray-800">Anggaran</th>
                                <th class="px-4 py-2 text-sm font-semibold text-left text-gray-800">Status</th>
                                <th class="px-4 py-2 text-sm font-semibold text-left text-gray-800">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($project as $resource)
                                <tr class="border-b">
                                    <td class="px-4 py-2 text-gray-700">{{ $resource->name }}</td>
                                    <td class="px-4 py-2 text-gray-700">{{ $resource->description }}</td>
                                    <td class="px-4 py-2 text-gray-700">{{ $resource->start_date }}</td>
                                    <td class="px-4 py-2 text-gray-700">{{ $resource->end_date }}</td>
                                    <td class="px-4 py-2 text-gray-700">{{ $resource->anggaran }}</td>
                                    <td class="px-4 py-2 text-gray-700">
                                        @if ($resource->status === 'Approval Request')
                                            <form action="{{ route('proyek.updateStatus', $resource->id) }}"
                                                method="POST">
                                                @csrf
                                                @method('PATCH')
                                                <button type="submit"
                                                    class="text-white bg-green-700 hover:bg-green-800 focus:outline-none focus:ring-4 focus:ring-green-300 font-medium rounded-full text-sm px-5 py-2.5 text-center me-2 mb-2"
                                                    title="Move to Completed">Approve
                                                </button>
                                            </form>
                                        @else
                                            <span
                                                class="focus:outline-none focus:ring-4font-medium rounded-full text-sm px-5 py-2.5 text-center me-2 mb-2">
                                                {{ $resource->status }}
                                            </span>
                                        @endif
                                    </td>
                                    <td class="flex px-4 py-2 space-x-2">
                                        <!-- Edit button -->
                                        <a href="{{ route('proyekdetail.index', $resource->id) }}"
                                            class="text-yellow-500 hover:text-yellow-600">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 20 20"
                                                fill="currentColor">
                                                <path fill-rule="evenodd"
                                                    d="M12.854 2.146a2 2 0 00-2.828 0l-8 8a2 2 0 00-.477.793l-2 7a1 1 0 001.209 1.209l7-2a2 2 0 00.793-.477l8-8a2 2 0 000-2.828l-2.828-2.828a2 2 0 00-2.828 0l-4.242 4.242a1 1 0 00-.293.707v4h-3V8.707a1 1 0 00-.293-.707L12.854 2.146z"
                                                    clip-rule="evenodd" />
                                            </svg>
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

                        <label for="manager" class="block mt-4 mb-2 text-sm font-medium text-gray-700">Manager
                            Project</label>
                        <select id="manager" name="manager"
                            class="w-full p-2 border border-gray-300 rounded focus:ring-blue-500 focus:border-blue-500"
                            required>
                            @foreach ($managers as $manager)
                                <option value="{{ $manager->id }}">{{ $manager->name }}</option>
                            @endforeach
                        </select>

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
