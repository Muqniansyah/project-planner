<x-app-layout>
    <x-slot name="title">
        Detail Proyek
    </x-slot>

    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            Project {{ $project->name }}
        </h2>
    </x-slot>

    <div class="flex flex-wrap justify-center gap-2 p-4 rounded-md shadow-sm" role="group">
        <button type="button" onclick="window.location='{{ route('proyekdetail.index', $project->id) }}'"
            class="px-4 py-2 text-sm font-medium text-center 
        {{ Route::current()->getName() == 'proyekdetail.index' ? 'rounded-full text-white bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 hover:bg-green-900' : 'text-green-700 border border-green-700 rounded-full hover:text-white hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300' }}">
            Task Project
        </button>
        <button type="button" onclick="window.location='{{ route('ManajemenSD.view', ['id' => $project->id]) }}'"
            class="px-4 py-2 text-sm font-medium text-center 
        {{ Request::is('ManajemenSD*') ? 'rounded-full text-white bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 hover:bg-green-900' : 'text-green-700 border border-green-700 rounded-full hover:text-white hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300' }}">
            Sumber Daya
        </button>
        
        @if (Auth::user()->role === 'manager')
            <button type="button" onclick="window.location='{{ route('Laporan.index', $project->id) }}'"
                class="px-4 py-2 text-sm font-medium text-center 
            {{ Request::is('Laporan*') ? 'rounded-full text-white bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 hover:bg-green-900' : 'text-green-700 border border-green-700 rounded-full hover:text-white hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300' }}">
                Project Report
            </button>
            <button type="button" onclick="window.location='{{ route('proyek.edit', $project->id) }}'"
                class="px-4 py-2 text-sm font-medium text-center 
        {{ Request::is('proyek/edit*') ? 'rounded-full text-white bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 hover:bg-green-900' : 'text-green-700 border border-green-700 rounded-full hover:text-white hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300' }}">
                Settings
            </button>
        @endif
        
    </div>


    <div class="main">
        @yield('content')
    </div>

    @if (Route::current()->getName() == 'proyekdetail.index')
        <div class="relative flex items-center justify-between m-4">
            <h1 class="mb-4 text-2xl font-bold text-gray-700">
                @php
                    $task = request()->get('task');
                @endphp
                @if ($task == 'kurva')
                    Kurva S
                @else
                    Gantt Chart
                @endif
            </h1>
            <!-- Tombol Dropdown -->
            <button type="button" class="relative flex text-sm rounded-full focus:outline-none" id="task-menu-button"
                aria-expanded="false" aria-haspopup="true">
                <span class="flex items-center pl-3 text-3xl"><i class="fa-solid fa-ellipsis-vertical"></i></span>
            </button>

            <!-- Dropdown Menu -->
            <div id="task-menu"
                class="absolute right-0 z-10 hidden w-48 py-1 mt-2 origin-top-right bg-white rounded-md shadow-lg ring-1 ring-black/5 focus:outline-none"
                role="menu" aria-orientation="vertical" aria-labelledby="task-menu-button" tabindex="-1">
                <a href="?task=gantt"
                    class="block px-4 py-2 text-sm  {{ $task == 'gantt' || !isset($task) ? 'bg-gray-500 text-white' : 'hover:bg-gray-500 text-gray-700 hover:text-white' }}"
                    role="menuitem" tabindex="-1" id="task-menu-item-0">Gantt Chart</a>
                <a href="?task=kurva"
                    class="block px-4 py-2 text-sm text-gray-700 {{ $task == 'kurva' ? 'bg-gray-500 text-white' : 'hover:bg-gray-500 text-gray-700 hover:text-white' }}"
                    role="menuitem" tabindex="-1" id="task-menu-item-1">Kurva S</a>
            </div>
        </div>

        @if ($task == 'kurva')
            @include('proyek.kurva')
        @else
            @include('proyek.ganttchart')
        @endif

        <script>
            const taskMenuButton = document.getElementById('task-menu-button');
            const taskMenu = document.getElementById('task-menu');

            // Toggle dropdown visibility
            taskMenuButton.addEventListener('click', () => {
                taskMenu.classList.toggle('hidden');
            });

            // Close dropdown when clicking outside
            document.addEventListener('click', (event) => {
                if (!taskMenuButton.contains(event.target) && !taskMenu.contains(event.target)) {
                    taskMenu.classList.add('hidden');
                }
            });
        </script>
    @endif


</x-app-layout>
