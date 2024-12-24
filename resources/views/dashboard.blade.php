<x-app-layout>
    <!-- Dashboard admin -->
    @if (Auth::user()->role == 'admin')
        <div class="py-6 mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3">
                <!-- Card User -->
                <div class="overflow-hidden bg-white rounded-lg shadow-lg">
                    <div class="p-6 text-center">
                        <h2 class="text-xl font-semibold text-gray-800">User</h2>
                        <p class="mt-2 text-gray-600">Manage users in your application</p>
                        <a href="{{ route('admin.user.create') }}"
                            class="inline-block px-4 py-2 mt-4 text-white bg-blue-500 rounded-lg hover:bg-blue-600">Go to
                            User</a>
                    </div>
                </div>

                <!-- Card Project -->
                <div class="overflow-hidden bg-white rounded-lg shadow-lg">
                    <div class="p-6 text-center">
                        <h2 class="text-xl font-semibold text-gray-800">Project</h2>
                        <p class="mt-2 text-gray-600">Manage your projects and tasks</p>
                        <a href="{{ route('proyek.index') }}"
                            class="inline-block px-4 py-2 mt-4 text-white bg-green-500 rounded-lg hover:bg-green-600">Go
                            to Project</a>
                    </div>
                </div>

                <!-- Card Sumberdaya -->
                <div class="overflow-hidden bg-white rounded-lg shadow-lg">
                    <div class="p-6 text-center">
                        <h2 class="text-xl font-semibold text-gray-800">Sumberdaya</h2>
                        <p class="mt-2 text-gray-600">Manage your resources effectively</p>
                        <a href="{{ route('ManajemenSD.index') }}"
                            class="inline-block px-4 py-2 mt-4 text-white bg-yellow-500 rounded-lg hover:bg-yellow-600">Go
                            to Sumberdaya</a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Dashbord Manager & Karyawan -->
    @else
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
                    <input type="text" name="search" placeholder="Cari Proyek..." value="{{ request('search') }}"
                        class="w-full p-2 border border-gray-300 rounded focus:ring-blue-500 focus:border-blue-500">
                    <button type="submit" class="px-4 py-2 text-white bg-blue-600 rounded hover:bg-blue-700">
                        Cari
                    </button>
                </form>
            </div>

            <div class="grid grid-cols-1 gap-6 lg:grid-cols-4">
                <!-- Pending Section -->
                <div class="p-6 bg-white rounded-lg shadow">
                    <h2 class="mb-4 text-lg font-semibold text-gray-700">Pending</h2>
                    <div class="space-y-4">
                        @forelse ($pendingProjects as $project)
                            <div class="relative p-4 bg-yellow-100 rounded-lg shadow hover:bg-yellow-200">
                                <!-- Klik area ini akan membuka modal -->
                                <div class="absolute inset-0 cursor-pointer"
                                    onclick="openModal('{{ $project->id }}', '{{ $project->name }}', '{{ $project->description }}', '{{ number_format($project->anggaran, 2) }}')">
                                </div>
                                <!-- Konten Card -->
                                <h3 class="font-semibold text-yellow-700 text-md">{{ $project->name }}</h3>
                                <p class="mt-2 text-sm text-yellow-600">Deskripsi: {{ $project->description }}</p>
                                <p class="mt-2 text-sm text-yellow-600">Anggaran:
                                    Rp.{{ number_format($project->anggaran, 2) }}</p>
                                <p class="mt-2 text-sm text-yellow-600">
                                    {{ \Carbon\Carbon::parse($project->start_date)->format('Y-m-d') }} -
                                    {{ \Carbon\Carbon::parse($project->end_date)->format('Y-m-d') }}</p>
                                <p class="mt-2 text-xs text-yellow-500">Status: {{ $project->status }}</p>

                                @if (Auth::user()->role === 'manager')
                                    <!-- Tombol -->
                                    <div class="relative z-10 flex justify-end mt-4 space-x-2">
                                        <a href="{{ route('proyekdetail.index', $project->id) }}"
                                            class="text-green-500 hover:text-green-700">
                                            <i class="text-lg bi bi-info-circle"></i>
                                        </a>
                                        <form action="{{ route('proyek.updateStatus', $project->id) }}" method="POST">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit" class="text-blue-500 hover:text-blue-700"
                                                title="Move to In Progress">
                                                <i class="text-lg bi bi-arrow-right-circle"></i>
                                            </button>
                                        </form>
                                    </div>
                                @else
                                    <!-- Tombol -->
                                    <div class="relative z-10 flex justify-end mt-4 space-x-2">

                                        <a href="{{ route('proyekdetail.index', $project->id) }}"
                                            class="text-green-500 hover:text-green-700">
                                            <i class="text-lg bi bi-info-circle"></i>
                                        </a>
                                    </div>
                                @endif
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
                                <div class="absolute inset-0 cursor-pointer"
                                    onclick="openModal('{{ $project->id }}', '{{ $project->name }}', '{{ $project->description }}', '{{ number_format($project->anggaran, 2) }}')">
                                </div>
                                <!-- Konten Card -->
                                <h3 class="font-semibold text-blue-700 text-md">{{ $project->name }}</h3>
                                <p class="mt-2 text-sm text-blue-600">Deskripsi: {{ $project->description }}</p>
                                <p class="mt-2 text-sm text-blue-600">Anggaran:
                                    Rp.{{ number_format($project->anggaran, 2) }}</p>
                                <p class="mt-2 text-sm text-blue-600">
                                    {{ \Carbon\Carbon::parse($project->start_date)->format('Y-m-d') }} -
                                    {{ \Carbon\Carbon::parse($project->end_date)->format('Y-m-d') }}</p>
                                </p>
                                <p class="mt-2 text-xs text-blue-500">Status: {{ $project->status }}</p>

                                @if (Auth::user()->role === 'manager')
                                    <!-- Tombol -->
                                    <div class="relative z-10 flex justify-end mt-4 space-x-2">
                                        <button type="button"
                                            onclick="window.location='{{ route('projects.pdf', $project->id) }}'"
                                            title="Export PDF"
                                            class="flex items-center justify-center px-4 py-2 text-red-500 rounded-lg text-red hover:text-red-600">
                                            <span class="material-symbols-outlined">picture_as_pdf</span>
                                        </button>
                                        <button type="button"
                                            onclick="window.location='{{ route('proyekdetail.index', $project->id) }}'"
                                            title="Detail Proyek" class="text-green-500 hover:text-green-700">
                                            <i class="text-lg bi bi-info-circle"></i>
                                        </button>
                                        <form action="{{ route('proyek.undo', $project->id) }}" method="POST"
                                            class="inline">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit" class="text-gray-500 hover:text-gray-700"
                                                title="Move to Pending">
                                                <i class="text-lg bi bi-arrow-counterclockwise"></i>
                                            </button>
                                        </form>
                                        <form action="{{ route('proyek.updateStatus', $project->id) }}" method="POST">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit" class="text-blue-500 hover:text-blue-700"
                                                title="Move to Completed">
                                                <i class="text-lg bi bi-arrow-right-circle"></i>
                                            </button>
                                        </form>
                                    </div>
                                @else
                                    <!-- Tombol -->
                                    <div class="relative z-10 flex justify-end mt-4 space-x-2">

                                        <a href="{{ route('proyekdetail.index', $project->id) }}"
                                            class="text-green-500 hover:text-green-700">
                                            <i class="text-lg bi bi-info-circle"></i>
                                        </a>
                                    </div>
                                @endif
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

                <!-- Approval Request Section -->
                <div id="in-progress-section" class="p-6 bg-white rounded-lg shadow">
                    <h2 class="mb-4 text-lg font-semibold text-gray-700">Approval Request</h2>
                    <div class="space-y-4">
                        @forelse ($approvalRequestProjects as $project)
                            <div class="relative p-4 bg-gray-100 rounded-lg shadow hover:bg-gray-200">
                                <!-- Klik area ini akan membuka modal -->
                                <div class="absolute inset-0 cursor-pointer"
                                    onclick="openModal('{{ $project->id }}', '{{ $project->name }}', '{{ $project->description }}', '{{ number_format($project->anggaran, 2) }}')">
                                </div>
                                <!-- Konten Card -->
                                <h3 class="font-semibold text-gray-700 text-md">{{ $project->name }}</h3>
                                <p class="mt-2 text-sm text-gray-600">Deskripsi: {{ $project->description }}</p>
                                <p class="mt-2 text-sm text-gray-600">Anggaran:
                                    Rp.{{ number_format($project->anggaran, 2) }}</p>
                                <p class="mt-2 text-sm text-gray-600">
                                    {{ \Carbon\Carbon::parse($project->start_date)->format('Y-m-d') }} -
                                    {{ \Carbon\Carbon::parse($project->end_date)->format('Y-m-d') }}</p>
                                </p>
                                <p class="mt-2 text-xs text-gray-500">Status: {{ $project->status }}</p>

                                @if (Auth::user()->role === 'manager')
                                    <!-- Tombol -->
                                    <div class="relative z-10 flex justify-end mt-4 space-x-2">
                                        <button type="button"
                                            onclick="window.location='{{ route('projects.pdf', $project->id) }}'"
                                            title="Export PDF"
                                            class="flex items-center justify-center px-4 py-2 text-red-500 rounded-lg text-red hover:text-red-600">
                                            <span class="material-symbols-outlined">picture_as_pdf</span>
                                        </button>
                                        <button type="button"
                                            onclick="window.location='{{ route('proyekdetail.index', $project->id) }}'"
                                            title="Detail Proyek" class="text-green-500 hover:text-green-700">
                                            <i class="text-lg bi bi-info-circle"></i>
                                        </button>
                                        <form action="{{ route('proyek.undo', $project->id) }}" method="POST"
                                            class="inline">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit" class="text-gray-500 hover:text-gray-700"
                                                title="Move to In Progress">
                                                <i class="text-lg bi bi-arrow-counterclockwise"></i>
                                            </button>
                                        </form>
                                    </div>
                                @else
                                    <!-- Tombol -->
                                    <div class="relative z-10 flex justify-end mt-4 space-x-2">

                                        <a href="{{ route('proyekdetail.index', $project->id) }}"
                                            class="text-green-500 hover:text-green-700">
                                            <i class="text-lg bi bi-info-circle"></i>
                                        </a>
                                    </div>
                                @endif
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
                                <div class="absolute inset-0 cursor-pointer"
                                    onclick="openModal('{{ $project->id }}', '{{ $project->name }}', '{{ $project->description }}', '{{ number_format($project->anggaran, 2) }}')">
                                </div>
                                <!-- Konten Card -->
                                <h3 class="font-semibold text-green-700 text-md">{{ $project->name }}</h3>
                                <p class="mt-2 text-sm text-green-600">Deskripsi: {{ $project->description }}</p>
                                <p class="mt-2 text-sm text-green-600">Anggaran:
                                    Rp.{{ number_format($project->anggaran, 2) }}</p>
                                <p class="mt-2 text-sm text-green-600">
                                    {{ \Carbon\Carbon::parse($project->start_date)->format('Y-m-d') }} -
                                    {{ \Carbon\Carbon::parse($project->end_date)->format('Y-m-d') }}</p>
                                </p>
                                <p class="mt-2 text-xs text-green-500">Status: {{ $project->status }}</p>

                                @if (Auth::user()->role === 'manager')
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
                                    </div>
                                @else
                                    <!-- Tombol -->
                                    <div class="relative z-10 flex justify-end mt-4 space-x-2">

                                        <a href="{{ route('proyekdetail.index', $project->id) }}"
                                            class="text-green-500 hover:text-green-700">
                                            <i class="text-lg bi bi-info-circle"></i>
                                        </a>
                                    </div>
                                @endif
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
                <div id="projectModal"
                    class="fixed inset-0 z-50 flex items-center justify-center hidden bg-gray-800 bg-opacity-75">
                    <div class="w-1/3 bg-white rounded-lg shadow-lg">
                        <div class="p-6">
                            <h3 id="modalTitle" class="text-lg font-semibold text-gray-700"></h3>
                            <p id="modalDescription" class="mt-4 text-sm text-gray-600"></p>
                            <p id="modalAnggaran" class="mt-4 text-sm text-gray-600"></p>
                            <div class="flex justify-end mt-6 space-x-4">
                                <button onclick="closeModal('projectModal')"
                                    class="px-4 py-2 text-sm text-white bg-gray-500 rounded hover:bg-gray-600">Close</button>
                                @if (Auth::user()->role === 'manager')
                                    <a href="#" id="editButton"
                                        class="px-4 py-2 text-sm text-white bg-blue-500 rounded hover:bg-blue-600">Edit</a>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif

</x-app-layout>
