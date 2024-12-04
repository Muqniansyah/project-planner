    {{-- <x-app-layout> --}}
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200&icon_names=add_2" />        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200&icon_names=more_time" />
        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])


    </head>

    {{-- Memasukkan navigasi utama --}}
    @include('navigasiutama')

 
      <div class="bg-[gray-100 min-h-screen]">


        <!-- Main Content -->
        <main class="py-6">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Pending Section -->
            <div>
                <h2 class="text-lg font-semibold text-gray-700 mb-4">Pending</h2>
                <div class="space-y-4">
                    <!-- Card 1 -->
                    <div class="bg-yellow-100 shadow rounded-lg p-4">
                        <h3 class="text-md font-semibold text-yellow-700">Task A</h3>
                        <p class="text-sm text-yellow-600 mt-2">Awaiting review before assignment.</p>
                        <p class="mt-2 text-xs text-yellow-500">Due: Dec 5, 2024</p>
                    </div>
                    <!-- Card 2 -->
                    <div class="bg-yellow-100 shadow rounded-lg p-4">
                        <h3 class="text-md font-semibold text-yellow-700">Task B</h3>
                        <p class="text-sm text-yellow-600 mt-2">Pending approval from the manager.</p>
                        <p class="mt-2 text-xs text-yellow-500">Due: Dec 6, 2024</p>
                    </div>
                </div>
            </div>

            <!-- In Progress Section -->
            <div>
                <h2 class="text-lg font-semibold text-gray-700 mb-4">In Progress</h2>
                <div class="space-y-4">
                    <!-- Card 1 -->
                    <div class="bg-blue-100 shadow rounded-lg p-4">
                        <h3 class="text-md font-semibold text-blue-700">Task C</h3>
                        <p class="text-sm text-blue-600 mt-2">Work is ongoing. Expected completion by next week.</p>
                        <p class="mt-2 text-xs text-blue-500">Started: Dec 1, 2024</p>
                    </div>
                    <!-- Card 2 -->
                    <div class="bg-blue-100 shadow rounded-lg p-4">
                        <h3 class="text-md font-semibold text-blue-700">Task D</h3>
                        <p class="text-sm text-blue-600 mt-2">Under review by QA team.</p>
                        <p class="mt-2 text-xs text-blue-500">Started: Nov 30, 2024</p>
                    </div>
                </div>
            </div>

            <!-- Completed Section -->
            <div>
                <h2 class="text-lg font-semibold text-gray-700 mb-4">Completed</h2>
                <div class="space-y-4">
                    <!-- Card 1 -->
                    <div class="bg-green-100 shadow rounded-lg p-4">
                        <h3 class="text-md font-semibold text-green-700">Task E</h3>
                        <p class="text-sm text-green-600 mt-2">Successfully completed and delivered.</p>
                        <p class="mt-2 text-xs text-green-500">Completed: Nov 25, 2024</p>
                    </div>
                    <!-- Card 2 -->
                    <div class="bg-green-100 shadow rounded-lg p-4">
                        <h3 class="text-md font-semibold text-green-700">Task F</h3>
                        <p class="text-sm text-green-600 mt-2">Final review passed and archived.</p>
                        <p class="mt-2 text-xs text-green-500">Completed: Nov 20, 2024</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

    {{-- </x-app-layout>   --}}



