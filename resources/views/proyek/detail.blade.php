<x-app-layout>
    <x-slot name="title">
        Detail Proyek
    </x-slot>


    {{-- <nav class="bg-white border-gray-200 ">
        <div class="flex flex-wrap items-center justify-between p-4 mx-auto">
            <button data-collapse-toggle="navbar-default" type="button"
                class="inline-flex items-center justify-center w-10 h-10 p-2 text-sm text-gray-500 rounded-lg md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 "
                aria-controls="navbar-default" aria-expanded="false">
                <span class="sr-only">Open main menu</span>
                <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                    viewBox="0 0 17 14">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M1 1h15M1 7h15M1 13h15" />
                </svg>
            </button>
            <div class="hidden w-full md:block md:w-auto" id="navbar-default">
                <ul
                    class="flex flex-col p-4 mt-4 font-medium border border-gray-100 rounded-lg md:p-0 bg-gray-50 md:flex-row md:space-x-8 rtl:space-x-reverse md:mt-0 md:border-0 md:bg-white ">
                    <li>
                        <a href="#"
                            class="block px-3 py-2 text-white bg-blue-700 rounded md:bg-transparent md:text-blue-700 md:p-0 "
                            aria-current="page">Task Project</a>
                    </li>
                    <li>
                        <a href="#"
                            class="block px-3 py-2 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0 ">Sumber
                            Daya</a>
                    </li>
                    <li>
                        <a href="#"
                            class="block px-3 py-2 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0 ">Setting</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav> --}}



    <div class="flex justify-center rounded-md shadow-sm" role="group">
        <!-- <button type="button"
            class="px-4 py-2 mb-2 text-sm font-medium text-center text-green-700 border border-green-700 rounded-full hover:text-white hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 me-2 ">
            Task Project
        </button> -->
        <button type="button"
            onclick="window.location='{{ route('ManajemenSD.view', ['id' => $project->id]) }}'"
            class="px-4 py-2 mb-2 text-sm font-medium text-center text-green-700 border border-green-700 rounded-full hover:text-white hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 me-2">
            Sumber Daya 
        </button>
        <button type="button"
            class="px-4 py-2 mb-2 text-sm font-medium text-center text-green-700 border border-green-700 rounded-full hover:text-white hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 me-2">
            Settings
        </button>
        <button type="button"
            onclick="window.location='{{ route('Laporan.index') }}'"
            class="px-4 py-2 mb-2 text-sm font-medium text-center text-green-700 border border-green-700 rounded-full hover:text-white hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 me-2">
            Project Report
        </button>

    </div>


    <div class="relative flex items-center justify-end m-4">
        <!-- Tombol Dropdown -->
        <button type="button" class="relative flex text-sm rounded-full focus:outline-none" id="task-menu-button"
            aria-expanded="false" aria-haspopup="true">
            <span class="flex items-center pl-3 text-3xl"><i class="fa-solid fa-ellipsis-vertical"></i></span>
        </button>

        <!-- Dropdown Menu -->
        <div id="task-menu"
            class="absolute right-0 z-10 hidden w-48 py-1 mt-2 origin-top-right bg-white rounded-md shadow-lg ring-1 ring-black/5 focus:outline-none"
            role="menu" aria-orientation="vertical" aria-labelledby="task-menu-button" tabindex="-1">
            <a href="?task=gantt" class="block px-4 py-2 text-sm text-gray-700" role="menuitem" tabindex="-1"
                id="task-menu-item-0">Gantt Chart</a>
            <a href="?task=kurva" class="block px-4 py-2 text-sm text-gray-700" role="menuitem" tabindex="-1"
                id="task-menu-item-1">Kurva S</a>
        </div>
    </div>
    @php
        $task = request()->get('task');
    @endphp
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


</x-app-layout>
