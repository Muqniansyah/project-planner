{{-- <x-app-layout> --}}
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <header class="bg-white">
      <nav class="mx-auto flex max-w-7xl items-center justify-between p-6 lg:px-8" aria-label="Global">
          <div class="flex">
              <!-- Logo -->
              <div class="shrink-0 flex items-center">
                  <a href="{{ route('dashboard') }}">
                      <x-application-logo class="block h-9 w-auto fill-current text-gray-800" />
                  </a>
              </div>

              <!-- Navigation Links -->
              <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                  <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                      {{ __('Dashboard') }}
                  </x-nav-link>
              </div>
          </div>

          <!-- Mobile Menu Button -->
          <div class="flex lg:hidden">
              <button type="button" class="-m-2.5 inline-flex items-center justify-center rounded-md p-2.5 text-gray-700">
                  <span class="sr-only">Open main menu</span>
                  <svg class="size-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                      <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                  </svg>
              </button>
          </div>

          <!-- Desktop Navigation -->
          <div class="hidden lg:flex lg:gap-x-12">
              <!-- Dropdown Menu -->
              <div class="relative">
                  <button type="button" class="flex items-center gap-x-1 text-sm font-semibold text-gray-900" data-dropdown-button>
                      Project Report
                      <svg class="size-5 flex-none text-gray-400" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                          <path fill-rule="evenodd" d="M5.22 8.22a.75.75 0 0 1 1.06 0L10 11.94l3.72-3.72a.75.75 0 1 1 1.06 1.06l-4.25 4.25a.75.75 0 0 1-1.06 0L5.22 9.28a.75.75 0 0 1 0-1.06Z" clip-rule="evenodd" />
                      </svg>
                  </button>
                  <div class="absolute -left-8 top-full z-10 mt-3 w-screen max-w-md overflow-hidden rounded-3xl bg-white shadow-lg ring-1 ring-gray-900/5" data-dropdown-menu>
                      <div class="p-4">
                          <div class="group relative flex items-center gap-x-6 rounded-lg p-4 hover:bg-gray-50">
                              <div class="flex size-11 flex-none items-center justify-center rounded-lg bg-gray-50 group-hover:bg-white">
                                  <svg class="size-6 text-gray-600 group-hover:text-indigo-600" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                                      <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 6a7.5 7.5 0 1 0 7.5 7.5h-7.5V6Z" />
                                      <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 10.5H21A7.5 7.5 0 0 0 13.5 3v7.5Z" />
                                  </svg>
                              </div>
                              <div class="flex-auto">
                                  <a href="{{ route('pendjadwalan.index') }}" class="block font-semibold text-gray-900">Pendjadwalan</a>
                                  <p class="mt-1 text-gray-600">Get a better understanding of your traffic</p>
                              </div>
                          </div>
                          <div class="group relative flex items-center gap-x-6 rounded-lg p-4 hover:bg-gray-50">
                              <div class="flex size-11 flex-none items-center justify-center rounded-lg bg-gray-50 group-hover:bg-white">
                                  <svg class="size-6 text-gray-600 group-hover:text-indigo-600" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                                      <path stroke-linecap="round" stroke-linejoin="round" d="M7.864 4.243A7.5 7.5 0 0 1 19.5 10.5c0 2.92-.556 5.709-1.568 8.268M5.742 6.364A7.465 7.465 0 0 0 4.5 10.5a7.464 7.464 0 0 1-1.15 3.993m1.989 3.559A11.209 11.209 0 0 0 8.25 10.5a3.75 3.75 0 1 1 7.5 0c0 .527-.021 1.049-.064 1.565M12 10.5a14.94 14.94 0 0 1-3.6 9.75m6.633-4.596a18.666 18.666 0 0 1-2.485 5.33" />
                                  </svg>
                              </div>
                              <div class="flex-auto">
                                  <a href="{{ route('Laporan.index') }}" class="block font-semibold text-gray-900">Laporan</a>
                                  <p class="mt-1 text-gray-600">Your customers’ data will be safe and secure</p>
                              </div>
                          </div>
                      </div>
                  </div>
              </div>
              <a href="{{ route('proyek.index') }}" class="text-sm font-semibold text-gray-900">Project</a>
              <a href="{{ route('ManajemenSD.index') }}" class="text-sm font-semibold text-gray-900">Resource Management</a>
              <a href="{{ route('settings.index') }}" class="text-sm font-semibold text-gray-900">Settings</a>
          </div>

          <!-- Settings Dropdown -->
          <div class="hidden sm:flex sm:items-center sm:ms-6">
              <x-dropdown align="right" width="48">
                  <x-slot name="trigger">
                      <button class="inline-flex items-center px-3 py-2 border text-sm font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none">
                          <div>{{ Auth::user()->name }}</div>
                          <div class="ms-1">
                              <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                  <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                              </svg>
                          </div>
                      </button>
                  </x-slot>
                  <x-slot name="content">
                      <x-dropdown-link :href="route('profile.edit')">{{ __('Profile') }}</x-dropdown-link>
                      <form method="POST" action="{{ route('logout') }}">
                          @csrf
                          <x-dropdown-link :href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();">
                              {{ __('Log Out') }}
                          </x-dropdown-link>
                      </form>
                  </x-slot>
              </x-dropdown>
          </div>
      </nav>
    </header>

    <!-- background dashboard -->
    <div class="bg-gray-100 min-h-screen">

    <!-- Main Content -->
    <main class="py-6">
        @if (session('success'))
            <div class="bg-green-100 text-green-700 p-4 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="bg-red-100 text-red-700 p-4 rounded mb-4">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!--  -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                <!-- Pending Section -->
                <div class="bg-white shadow rounded-lg p-6">
                    <h2 class="text-lg font-semibold text-gray-700 mb-4">Pending</h2>
                    <div class="space-y-4">
                        @forelse ($pendingProjects as $project)
                            <div class="bg-yellow-100 shadow rounded-lg p-4 hover:bg-yellow-200">
                                <h3 class="text-md font-semibold text-yellow-700">{{ $project->name }}</h3>
                                <p class="text-sm text-yellow-600 mt-2">Deskripsi: {{ $project->description }}</p>
                                <p class="text-sm text-yellow-600 mt-2">Anggaran: ${{ number_format($project->anggaran, 2) }}</p>
                                <p class="mt-2 text-xs text-yellow-500">Status: {{ $project->status }}</p>

                                <!-- Tombol Next -->
                                <div class="mt-4 flex justify-end">
                                    <button 
                                        class="bg-blue-500 text-white font-semibold py-2 px-4 rounded-lg hover:bg-blue-600 flex items-center">
                                        Next <i class="bi bi-arrow-right ms-2"></i>
                                    </button>
                                </div>
                            </div>
                        @empty
                            <p class="text-gray-500">Tidak ada proyek dengan status Pending.</p>
                        @endforelse
                    </div>
                </div>

                <!-- In Progress Section -->
                <div id="in-progress-section" class="bg-white shadow rounded-lg p-6">
                    <h2 class="text-lg font-semibold text-gray-700 mb-4">In Progress</h2>
                    <div class="space-y-4">
                        <!-- Card untuk proyek yang sedang In Progress -->
                        @forelse ($inProgressProjects as $project)
                            <div id="project-{{ $project->id }}" class="bg-blue-100 shadow rounded-lg p-4 hover:bg-blue-200">
                                <h3 class="text-md font-semibold text-blue-700">{{ $project->name }}</h3>
                                <p class="text-sm text-blue-600 mt-2">Deskripsi: {{ $project->description }}</p>
                                <p class="text-sm text-blue-600 mt-2">Anggaran: ${{ number_format($project->anggaran, 2) }}</p>
                                <p class="mt-2 text-xs text-blue-500">Status: {{ $project->status }}</p>
                            </div>
                        @empty
                            <p class="text-gray-500">Tidak ada proyek dengan status In Progress.</p>
                        @endforelse
                    </div>
                </div>

                <!-- Completed Section -->
                <div class="bg-white shadow rounded-lg p-6">
                    <h2 class="text-lg font-semibold text-gray-700 mb-4">Completed</h2>
                    <div class="space-y-4">
                        <!-- Card 1 -->
                        <div 
                            @click="openModal('Project E', 'Successfully completed and delivered.', '$20,000', 'Material E', 100, 'Completed', 'Sarah Green', 'Nov 25, 2024')" 
                            class="cursor-pointer bg-green-100 shadow rounded-lg p-4 hover:bg-green-200">
                            <h3 class="text-md font-semibold text-green-700">Project E</h3>
                            <p class="text-sm text-green-600 mt-2">Anggaran: $20,000</p>
                            <p class="text-sm text-green-600 mt-2">Sumber Daya Material: Material E</p>
                            <p class="mt-2 text-xs text-green-500">Status: Completed</p>

                            <!-- Tombol Undo -->
                            <div class="mt-4 flex justify-start">
                                <button 
                                    class="bg-gray-500 text-white font-semibold py-2 px-4 rounded-lg hover:bg-gray-600 flex items-center"
                                    @click.stop="undoAction()">
                                    <i class="bi bi-arrow-counterclockwise me-2"></i> Undo
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </main>

{{-- </x-app-layout>   --}}



