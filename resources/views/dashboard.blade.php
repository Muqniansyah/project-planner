<x-app-layout>

    @if (session('success'))
        <div class="p-4 mb-4 text-green-700 bg-green-100 rounded">
            {{ session('success') }}
        </div>
    @endif

    @if ($errors->any())
        <div class="p-4 mb-4 text-red-700 bg-red-100 rounded">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
        <!-- Pencarian -->
        <div class="flex items-center mb-6 space-x-4">
            <form method="GET" action="{{ route('dashboard') }}" class="flex items-center w-full space-x-4">
                <input 
                    type="text" 
                    name="search" 
                    placeholder="Cari Proyek..." 
                    value="{{ request('search') }}" 
                    class="w-full p-2 border border-gray-300 rounded focus:ring-blue-500 focus:border-blue-500"
                >
                <button 
                    type="submit" 
                    class="px-4 py-2 text-white bg-blue-600 rounded hover:bg-blue-700"
                >
                    Cari
                </button>
            </form>
        </div>

        <div class="grid grid-cols-1 gap-6 lg:grid-cols-3">
            <!-- Pending Section -->
            <div class="p-6 bg-white rounded-lg shadow">
                <h2 class="mb-4 text-lg font-semibold text-gray-700">Pending</h2>
                <div class="space-y-4">
                    @forelse ($pendingProjects as $project)
                        <div class="relative p-4 bg-yellow-100 rounded-lg shadow hover:bg-yellow-200">
                            <!-- Klik area ini akan membuka modal -->
                            <div 
                                class="absolute inset-0 cursor-pointer"
                                onclick="openModal('{{ $project->id }}', '{{ $project->name }}', '{{ $project->description }}', '{{ number_format($project->anggaran, 2) }}')">
                            </div>
                            <!-- Konten Card -->
                            <h3 class="font-semibold text-yellow-700 text-md">{{ $project->name }}</h3>
                            <p class="mt-2 text-sm text-yellow-600">Deskripsi: {{ $project->description }}</p>
                            <p class="mt-2 text-sm text-yellow-600">Anggaran: Rp.{{ number_format($project->anggaran, 2) }}</p>
                            <p class="mt-2 text-sm text-yellow-600">{{ $project->start_date }} - {{ $project->end_date }}</p>
                            <p class="mt-2 text-xs text-yellow-500">Status: {{ $project->status }}</p>

                            <!-- Tombol -->
                            <div class="relative z-10 flex justify-end mt-4 space-x-2">
                                <a href="{{ route('projects.pdf', $project->id) }}" 
                                    class="flex items-center justify-center px-4 py-2 text-red-500 rounded-lg text-red hover:text-red-600">
                                    <span class="material-symbols-outlined">picture_as_pdf</span>
                                </a>
                                <a href="{{ route('proyekdetail.index', $project->id) }}"
                                    class="text-green-500 hover:text-green-700">
                                    <i class="text-lg bi bi-info-circle"></i>
                                </a>
                                <form action="{{ route('proyek.updateStatus', $project->id) }}" method="POST">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" class="text-blue-500 hover:text-blue-700" title="Move to In Progress">
                                        <i class="text-lg bi bi-arrow-right-circle"></i>
                                    </button>
                                </form>
                            </div>
                        </div>
                    @empty
                        <p class="text-gray-500">Tidak ada proyek dengan status Pending.</p>
                    @endforelse
                </div>

                <!-- Pagination Links -->
                <div class="flex justify-center mt-6">
                    {{ $pendingProjects->appends(request()->query())->links() }}
                </div>
            </div>

            <!-- In Progress Section -->
            <div id="in-progress-section" class="p-6 bg-white rounded-lg shadow">
                <h2 class="mb-4 text-lg font-semibold text-gray-700">In Progress</h2>
                <div class="space-y-4">
                    @forelse ($inProgressProjects as $project)
                        <div class="relative p-4 bg-blue-100 rounded-lg shadow hover:bg-blue-200">
                            <!-- Klik area ini akan membuka modal -->
                            <div 
                                class="absolute inset-0 cursor-pointer"
                                onclick="openModal('{{ $project->id }}', '{{ $project->name }}', '{{ $project->description }}', '{{ number_format($project->anggaran, 2) }}')">
                            </div>
                            <!-- Konten Card -->
                            <h3 class="font-semibold text-blue-700 text-md">{{ $project->name }}</h3>
                            <p class="mt-2 text-sm text-blue-600">Deskripsi: {{ $project->description }}</p>
                            <p class="mt-2 text-sm text-blue-600">Anggaran: Rp.{{ number_format($project->anggaran, 2) }}</p>
                            <p class="mt-2 text-sm text-blue-600">{{ $project->start_date }} - {{ $project->end_date }}</p>
                            <p class="mt-2 text-xs text-blue-500">Status: {{ $project->status }}</p>

                            <!-- Tombol -->
                            <div class="relative z-10 flex justify-end mt-4 space-x-2" >
                                <button type="button" onclick="window.location='{{ route('projects.pdf', $project->id) }}'" title="Export PDF"
                                    class="flex items-center justify-center px-4 py-2 text-red-500 rounded-lg text-red hover:text-red-600">
                                    <span class="material-symbols-outlined">picture_as_pdf</span>
                                </button>
                                <button type="button" onclick="window.location='{{ route('proyekdetail.index', $project->id) }}'" title="Detail Proyek"
                                    class="text-green-500 hover:text-green-700">
                                    <i class="text-lg bi bi-info-circle"></i>
                                </button>
                                <form action="{{ route('proyek.undo', $project->id) }}" method="POST" class="inline">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" class="text-gray-500 hover:text-gray-700" title="Move to Pending">
                                        <i class="text-lg bi bi-arrow-counterclockwise"></i>
                                    </button>
                                </form>
                                <form action="{{ route('proyek.updateStatus', $project->id) }}" method="POST">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" class="text-blue-500 hover:text-blue-700" title="Move to Completed">
                                        <i class="text-lg bi bi-arrow-right-circle"></i>
                                    </button>
                                </form>
                            </div>
                        </div>
                    @empty
                        <p class="text-gray-500">Tidak ada proyek dengan status In Progress.</p>
                    @endforelse
                </div>

                <!-- Pagination Links -->
                <div class="flex justify-center mt-6">
                {{ $inProgressProjects->links() }}
                </div>
            </div>

            <!-- Completed Section -->
            <div id="completed-section" class="p-6 bg-white rounded-lg shadow">
                <h2 class="mb-4 text-lg font-semibold text-gray-700">Completed</h2>
                <div class="space-y-4">
                    @forelse ($completedProjects as $project)
                        <div class="relative p-4 bg-green-100 rounded-lg shadow hover:bg-green-200">
                            <!-- Klik area ini akan membuka modal -->
                            <div 
                                class="absolute inset-0 cursor-pointer"
                                onclick="openModal('{{ $project->id }}', '{{ $project->name }}', '{{ $project->description }}', '{{ number_format($project->anggaran, 2) }}')">
                            </div>
                            <!-- Konten Card -->
                            <h3 class="font-semibold text-green-700 text-md">{{ $project->name }}</h3>
                            <p class="mt-2 text-sm text-green-600">Deskripsi: {{ $project->description }}</p>
                            <p class="mt-2 text-sm text-green-600">Anggaran: Rp.{{ number_format($project->anggaran, 2) }}</p>
                            <p class="mt-2 text-sm text-green-600">{{ $project->start_date }} - {{ $project->end_date }}</p>
                            <p class="mt-2 text-xs text-green-500">Status: {{ $project->status }}</p>

                            <!-- Tombol -->
                            <div class="relative z-10 flex justify-end mt-4 space-x-2">
                                <a href="{{ route('projects.pdf', $project->id) }}" 
                                    class="flex items-center justify-center px-4 py-2 text-red-500 rounded-lg text-red hover:text-red-600">
                                    <span class="material-symbols-outlined">picture_as_pdf</span>
                                </a>
                                <a href="{{ route('proyekdetail.index', $project->id) }}"
                                    class="text-green-500 hover:text-green-700">
                                    <i class="text-lg bi bi-info-circle"></i>
                                </a>
                                <form action="{{ route('proyek.undo', $project->id) }}" method="POST" class="inline">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" class="text-gray-500 hover:text-gray-700" title="Move to In Progress">
                                        <i class="text-lg bi bi-arrow-counterclockwise"></i>
                                    </button>
                                </form>
                            </div>
                        </div>
                    @empty
                        <p class="text-gray-500">Tidak ada proyek dengan status Completed.</p>
                    @endforelse
                </div>

                <!-- Pagination Links -->
                <div class="flex justify-center mt-6">
                    {{ $completedProjects->appends(request()->query())->links() }}
                </div>
            </div>

            <!-- Modal Box -->
            <!-- Modal Box 1 (Project Details) -->
            <div id="projectModal" class="fixed inset-0 z-50 flex items-center justify-center hidden bg-gray-800 bg-opacity-75">
                <div class="w-1/3 bg-white rounded-lg shadow-lg">
                    <div class="p-6">
                        <h3 id="modalTitle" class="text-lg font-semibold text-gray-700"></h3>
                        <p id="modalDescription" class="mt-4 text-sm text-gray-600"></p>
                        <p id="modalAnggaran" class="mt-4 text-sm text-gray-600"></p>
                        <div class="flex justify-end mt-6 space-x-4">
                            <button onclick="closeModal('projectModal')" class="px-4 py-2 text-sm text-white bg-gray-500 rounded hover:bg-gray-600">Close</button>
                            <a href="#" id="editButton" class="px-4 py-2 text-sm text-white bg-blue-500 rounded hover:bg-blue-600">Edit</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>