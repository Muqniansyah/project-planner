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
        <!--  -->
        <div class="grid grid-cols-1 gap-6 lg:grid-cols-3">
            <!-- Pending Section -->
            <div class="p-6 bg-white rounded-lg shadow">
                <h2 class="mb-4 text-lg font-semibold text-gray-700">Pending</h2>
                <div class="space-y-4">
                    @forelse ($pendingProjects as $project)
                        <div class="p-4 bg-yellow-100 rounded-lg shadow hover:bg-yellow-200">
                            <h3 class="font-semibold text-yellow-700 text-md">{{ $project->name }}</h3>
                            <p class="mt-2 text-sm text-yellow-600">Deskripsi: {{ $project->description }}</p>
                            <p class="mt-2 text-sm text-yellow-600">Anggaran:
                                ${{ number_format($project->anggaran, 2) }}</p>
                            <p class="mt-2 text-xs text-yellow-500">Status: {{ $project->status }}</p>

                            <!-- Tombol Export PDF -->
                            <div class="flex justify-end mt-4">
                                 <a href="{{ route('projects.pdf', $project->id) }}" 
                                 class="px-4 py-2 text-white bg-red-500 rounded-lg hover:bg-red-600">
                                     Export PDF
                                </a>
                            </div>

                            <!-- Tombol Next -->
                            <div class="flex justify-end mt-4">
                                <a
                                    href="{{ route('proyekdetail.index', $project->id) }}" class="flex items-center px-4 py-2 font-semibold text-white bg-green-500 rounded-lg hover:bg-green-600 me-2">
                                    Detail <i class="bi bi-arrow-right ms-2"></i>
                                </a>
                                <form action="{{ route('proyek.updateStatus', $project->id) }}" method="POST">
                                    @csrf
                                    @method('PATCH')

                                    <button type="submit"
                                    class="flex items-center px-4 py-2 font-semibold text-white bg-blue-500 rounded-lg hover:bg-blue-600">
                                    Next <i class="bi bi-arrow-right ms-2"></i>
                                </button>
                                </form>

                            </div>
                        </div>
                    @empty
                        <p class="text-gray-500">Tidak ada proyek dengan status Pending.</p>
                    @endforelse
                </div>
            </div>

            <!-- In Progress Section -->
            <div id="in-progress-section" class="p-6 bg-white rounded-lg shadow">
                <h2 class="mb-4 text-lg font-semibold text-gray-700">In Progress</h2>
                <div class="space-y-4">
                    <!-- Card untuk proyek yang sedang In Progress -->
                    @forelse ($inProgressProjects as $project)
                        <div id="project-{{ $project->id }}"
                            class="p-4 bg-blue-100 rounded-lg shadow hover:bg-blue-200">
                            <h3 class="font-semibold text-blue-700 text-md">{{ $project->name }}</h3>
                            <p class="mt-2 text-sm text-blue-600">Deskripsi: {{ $project->description }}</p>
                            <p class="mt-2 text-sm text-blue-600">Anggaran: ${{ number_format($project->anggaran, 2) }}
                            </p>
                            <p class="mt-2 text-xs text-blue-500">Status: {{ $project->status }}</p>

                            <!-- Tombol Export PDF -->
                            <div class="flex justify-end mt-4">
                                <a href="{{ route('projects.pdf', $project->id) }}" 
                                    class="px-4 py-2 text-white bg-red-500 rounded-lg hover:bg-red-600">
                                Export PDF
                                </a>
                            </div>

                            <div class="flex justify-end mt-4">
                                <a
                                    href="{{ route('proyekdetail.index', $project->id) }}" class="flex items-center px-4 py-2 font-semibold text-white bg-green-500 rounded-lg hover:bg-green-600 me-2">
                                    Detail <i class="bi bi-arrow-right ms-2"></i>
                                </a>
                                <a href="{{ route('proyek.updateStatus', $project->id) }}"
                                    class="flex items-center px-4 py-2 font-semibold text-white bg-blue-500 rounded-lg hover:bg-blue-600">
                                    Next <i class="bi bi-arrow-right ms-2"></i>
                                </a>
                            </div>
                        </div>
                    @empty
                        <p class="text-gray-500">Tidak ada proyek dengan status In Progress.</p>
                    @endforelse
                </div>
            </div>

            <!-- Completed Section -->
            <div class="p-6 bg-white rounded-lg shadow">
                <h2 class="mb-4 text-lg font-semibold text-gray-700">Completed</h2>
                <div class="space-y-4">
                    <!-- Card 1 -->
                    <div @click="openModal('Project E', 'Successfully completed and delivered.', '$20,000', 'Material E', 100, 'Completed', 'Sarah Green', 'Nov 25, 2024')"
                        class="p-4 bg-green-100 rounded-lg shadow cursor-pointer hover:bg-green-200">
                        <h3 class="font-semibold text-green-700 text-md">Project E</h3>
                        <p class="mt-2 text-sm text-green-600">Anggaran: $20,000</p>
                        <p class="mt-2 text-sm text-green-600">Sumber Daya Material: Material E</p>
                        <p class="mt-2 text-xs text-green-500">Status: Completed</p>

                        <!-- Tombol Export PDF -->
                        <div class="flex justify-end mt-4">
                            <a href="{{ route('projects.pdf', $project->id) }}" 
                             class="px-4 py-2 text-white bg-red-500 rounded-lg hover:bg-red-600">
                                 File PDF
                            </a>
                        </div>
                        
                        <!-- Tombol Undo -->
                        <div class="flex justify-start mt-4">
                            <button
                                class="flex items-center px-4 py-2 font-semibold text-white bg-gray-500 rounded-lg hover:bg-gray-600"
                                @click.stop="undoAction()">
                                <i class="bi bi-arrow-counterclockwise me-2"></i> Undo
                            </button>
                        </div>

                        
                    </div>
                </div>
            </div>
        </div>

    </div>

</x-app-layout>
