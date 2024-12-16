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
                                onclick="openModal('{{ $project->name }}', '{{ $project->description }}', '{{ number_format($project->anggaran, 2) }}')">
                            </div>
                            <!-- Konten Card -->
                            <h3 class="font-semibold text-yellow-700 text-md">{{ $project->name }}</h3>
                            <p class="mt-2 text-sm text-yellow-600">Deskripsi: {{ $project->description }}</p>
                            <p class="mt-2 text-sm text-yellow-600">Anggaran: ${{ number_format($project->anggaran, 2) }}</p>
                            <p class="mt-2 text-xs text-yellow-500">Status: {{ $project->status }}</p>

                            <!-- Tombol -->
                            <div class="flex justify-end mt-4 space-x-2 relative z-10">
                                <a href="{{ route('projects.pdf', $project->id) }}" 
                                    class="px-4 py-2 text-red text-red-500 rounded-lg hover:text-red-600 flex items-center justify-center">
                                    <span class="material-symbols-outlined">picture_as_pdf</span>
                                </a>
                                <a href="{{ route('proyekdetail.index', $project->id) }}"
                                    class="text-green-500 hover:text-green-700">
                                    <i class="bi bi-info-circle text-lg"></i>
                                </a>
                                <form action="{{ route('proyek.updateStatus', $project->id) }}" method="POST">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" class="text-blue-500 hover:text-blue-700">
                                        <i class="bi bi-arrow-right-circle text-lg"></i>
                                    </button>
                                </form>
                            </div>
                        </div>
                    @empty
                        <p class="text-gray-500">Tidak ada proyek dengan status Pending.</p>
                    @endforelse
                </div>

                <!-- Pagination Links -->
                <div class="mt-6">
                    {{ $pendingProjects->links() }}
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
                                onclick="openModal('{{ $project->name }}', '{{ $project->description }}', '{{ number_format($project->anggaran, 2) }}')">
                            </div>
                            <!-- Konten Card -->
                            <h3 class="font-semibold text-blue-700 text-md">{{ $project->name }}</h3>
                            <p class="mt-2 text-sm text-blue-600">Deskripsi: {{ $project->description }}</p>
                            <p class="mt-2 text-sm text-blue-600">Anggaran: ${{ number_format($project->anggaran, 2) }}</p>
                            <p class="mt-2 text-xs text-blue-500">Status: {{ $project->status }}</p>

                            <!-- Tombol -->
                            <div class="flex justify-end mt-4 space-x-2 relative z-10">
                                <a href="{{ route('projects.pdf', $project->id) }}" 
                                    class="px-4 py-2 text-red text-red-500 rounded-lg hover:text-red-600 flex items-center justify-center">
                                    <span class="material-symbols-outlined">picture_as_pdf</span>
                                </a>
                                <a href="{{ route('proyekdetail.index', $project->id) }}"
                                    class="text-green-500 hover:text-green-700">
                                    <i class="bi bi-info-circle text-lg"></i>
                                </a>
                                <form action="{{ route('proyek.undo', $project->id) }}" method="POST" class="inline">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" class="text-gray-500 hover:text-gray-700">
                                        <i class="bi bi-arrow-counterclockwise text-lg"></i>
                                    </button>
                                </form>
                                <form action="{{ route('proyek.updateStatus', $project->id) }}" method="POST">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" class="text-blue-500 hover:text-blue-700">
                                        <i class="bi bi-arrow-right-circle text-lg"></i>
                                    </button>
                                </form>
                            </div>
                        </div>
                    @empty
                        <p class="text-gray-500">Tidak ada proyek dengan status In Progress.</p>
                    @endforelse
                </div>

                <!-- Pagination Links -->
                <div class="mt-6">
                    {{ $pendingProjects->links() }}
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
                                onclick="openModal('{{ $project->name }}', '{{ $project->description }}', '{{ number_format($project->anggaran, 2) }}')">
                            </div>
                            <!-- Konten Card -->
                            <h3 class="font-semibold text-green-700 text-md">{{ $project->name }}</h3>
                            <p class="mt-2 text-sm text-green-600">Deskripsi: {{ $project->description }}</p>
                            <p class="mt-2 text-sm text-green-600">Anggaran: ${{ number_format($project->anggaran, 2) }}</p>
                            <p class="mt-2 text-xs text-green-500">Status: {{ $project->status }}</p>

                            <!-- Tombol -->
                            <div class="flex justify-end mt-4 space-x-2 relative z-10">
                                <a href="{{ route('projects.pdf', $project->id) }}" 
                                    class="px-4 py-2 text-red text-red-500 rounded-lg hover:text-red-600 flex items-center justify-center">
                                    <span class="material-symbols-outlined">picture_as_pdf</span>
                                </a>
                                <a href="{{ route('proyekdetail.index', $project->id) }}"
                                    class="text-green-500 hover:text-green-700">
                                    <i class="bi bi-info-circle text-lg"></i>
                                </a>
                                <form action="{{ route('proyek.undo', $project->id) }}" method="POST" class="inline">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" class="text-gray-500 hover:text-gray-700">
                                        <i class="bi bi-arrow-counterclockwise text-lg"></i>
                                    </button>
                                </form>
                            </div>
                        </div>
                    @empty
                        <p class="text-gray-500">Tidak ada proyek dengan status Completed.</p>
                    @endforelse
                </div>

                <!-- Pagination Links -->
                <div class="mt-6">
                    {{ $pendingProjects->links() }}
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
                            <button onclick="openEditModal()" class="px-4 py-2 text-sm text-white bg-blue-500 rounded hover:bg-blue-600">Edit</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal Box 2 (Edit Form) -->
            <div id="editModal" class="fixed inset-0 z-50 flex items-center justify-center hidden bg-gray-800 bg-opacity-75">
                <div class="w-1/3 bg-white rounded-lg shadow-lg">
                    <div class="p-6">
                        <h3 class="text-lg font-semibold text-gray-700">Edit Project</h3>
                        
                        <!-- Form untuk perubahan -->
                        <form id="projectForm" method="POST">
                            <div class="mt-4">
                                <label for="judul" class="block text-sm text-gray-700">Judul</label>
                                <input type="text" id="judul" name="judul" class="w-full px-4 py-2 mt-1 border rounded-lg" value="{{ old('name') ?? $project->name }}"/>
                            </div>
                            <div class="mt-4">
                                <label for="deskripsi" class="block text-sm text-gray-700">Deskripsi</label>
                                <textarea id="deskripsi" name="deskripsi" class="w-full px-4 py-2 mt-1 border rounded-lg" rows="4" value="{{ old('description') ?? $project->description }}"></textarea>
                            </div>
                            <div class="mt-4">
                                <label for="anggaran" class="block text-sm text-gray-700">Anggaran</label>
                                <input type="number" id="anggaran" name="anggaran" class="w-full px-4 py-2 mt-1 border rounded-lg" value="{{ old('anggaran') ?? number_format($project->anggaran, 2) }}"/>
                            </div>
                            
                            <div class="flex justify-end mt-6 space-x-4">
                                <button type="button" onclick="closeModal('editModal')" class="px-4 py-2 text-sm text-white bg-gray-500 rounded hover:bg-gray-600">Close</button>
                                <button type="submit" class="px-4 py-2 text-sm text-white bg-blue-500 rounded hover:bg-blue-600">Save Changes</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>