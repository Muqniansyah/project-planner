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
          {{-- <div class="flex lg:flex-1">
            <a href="#" class="-m-1.5 p-1.5">
              <span class="sr-only">Your Notification</span>
              <img class="h-8 w-auto" src="https://tailwindui.com/plus/img/logos/mark.svg?color=indigo&shade=600" alt="">
            </a>
          </div> --}}
          <div class="flex lg:hidden">
            <button type="button" class="-m-2.5 inline-flex items-center justify-center rounded-md p-2.5 text-gray-700">
              <span class="sr-only">Open main menu</span>
              <svg class="size-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true" data-slot="icon">
                <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
              </svg>
            </button>
          </div>
          <div class="hidden lg:flex lg:gap-x-12">
            <div class="relative">
              <button type="button" 
                      class="flex items-center gap-x-1 text-sm/6 font-semibold text-gray-900" 
                      data-dropdown-button>
                  Project Report
                  <svg class="size-5 flex-none text-gray-400" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                      <path fill-rule="evenodd" d="M5.22 8.22a.75.75 0 0 1 1.06 0L10 11.94l3.72-3.72a.75.75 0 1 1 1.06 1.06l-4.25 4.25a.75.75 0 0 1-1.06 0L5.22 9.28a.75.75 0 0 1 0-1.06Z" clip-rule="evenodd" />
                  </svg>
              </button>

              {{-- <x-responsive-nav-link : href="route('logout')"
                            onclick="event.preventDefault();
                                        this.closest('form').submit();">
                        {{ __('ha') }}
            </x-responsive-nav-link> --}}

              <!--
                'Product' flyout menu, show/hide based on flyout menu state.

                Entering: "transition ease-out duration-200"
                  From: "opacity-0 translate-y-1"
                  To: "opacity-100 translate-y-0"
                Leaving: "transition ease-in duration-150"
                  From: "opacity-100 translate-y-0"
                  To: "opacity-0 translate-y-1"
              -->
              <div class="absolute -left-8 top-full z-10 mt-3 w-screen max-w-md overflow-hidden rounded-3xl bg-white shadow-lg ring-1 ring-gray-900/5"  data-dropdown-menu>
                <div class="p-4">
                  <div class="group relative flex items-center gap-x-6 rounded-lg p-4 text-sm/6 hover:bg-gray-50">
                    <div class="flex size-11 flex-none items-center justify-center rounded-lg bg-gray-50 group-hover:bg-white">
                      <svg class="size-6 text-gray-600 group-hover:text-indigo-600" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true" data-slot="icon">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 6a7.5 7.5 0 1 0 7.5 7.5h-7.5V6Z" />
                        <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 10.5H21A7.5 7.5 0 0 0 13.5 3v7.5Z" />
                      </svg>
                    </div>
                    <div class="flex-auto">
                      <a href="{{ route('pendjadwalan.index') }}" class="block font-semibold text-gray-900">
                        Pendjadwalan
                        <span class="absolute inset-0"></span>
                      </a>
                      <p class="mt-1 text-gray-600">Get a better understanding of your traffic</p>
                    </div>
                  </div>
                  <div class="group relative flex items-center gap-x-6 rounded-lg p-4 text-sm/6 hover:bg-gray-50">
                    <div class="flex size-11 flex-none items-center justify-center rounded-lg bg-gray-50 group-hover:bg-white">
                      <svg class="size-6 text-gray-600 group-hover:text-indigo-600" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true" data-slot="icon">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.042 21.672 13.684 16.6m0 0-2.51 2.225.569-9.47 5.227 7.917-3.286-.672ZM12 2.25V4.5m5.834.166-1.591 1.591M20.25 10.5H18M7.757 14.743l-1.59 1.59M6 10.5H3.75m4.007-4.243-1.59-1.59" />
                      </svg>
                    </div>
                    <div class="flex-auto">
                      <a href="{{ route('proyek.index') }}" class="block font-semibold text-gray-900">
                        proyek
                        <span class="absolute inset-0"></span>
                      </a>
                      <p class="mt-1 text-gray-600">Speak directly to your customers</p>
                    </div>
                  </div>
                  <div class="group relative flex items-center gap-x-6 rounded-lg p-4 text-sm/6 hover:bg-gray-50">
                    <div class="flex size-11 flex-none items-center justify-center rounded-lg bg-gray-50 group-hover:bg-white">
                      <svg class="size-6 text-gray-600 group-hover:text-indigo-600" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true" data-slot="icon">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M7.864 4.243A7.5 7.5 0 0 1 19.5 10.5c0 2.92-.556 5.709-1.568 8.268M5.742 6.364A7.465 7.465 0 0 0 4.5 10.5a7.464 7.464 0 0 1-1.15 3.993m1.989 3.559A11.209 11.209 0 0 0 8.25 10.5a3.75 3.75 0 1 1 7.5 0c0 .527-.021 1.049-.064 1.565M12 10.5a14.94 14.94 0 0 1-3.6 9.75m6.633-4.596a18.666 18.666 0 0 1-2.485 5.33" />
                      </svg>
                    </div>
                    <div class="flex-auto">
                      <a href="{{ route('Laporan.index') }}" class="block font-semibold text-gray-900">
                        Laporan
                        <span class="absolute inset-0"></span>
                      </a>
                      <p class="mt-1 text-gray-600">Your customers’ data will be safe and secure</p>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <a href="{{ route('ManajemenSD.index') }}" class="text-sm/6 font-semibold text-gray-900">Resource Managemen</a>
            <a href="{{ route('settings.index') }}" class="text-sm/6 font-semibold text-gray-900">Settings</a>
          </div>
          {{-- <div class="hidden lg:flex lg:flex-1 lg:justify-end">
            <a href="#" class="text-sm/6 font-semibold text-gray-900">Log in <span aria-hidden="true">&rarr;</span></a>
          </div> --}}
                      <!-- Settings Dropdown -->
                      <div class="hidden sm:flex sm:items-center sm:ms-6">
                        <x-dropdown align="right" width="48">
                            <x-slot name="trigger">
                                <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                                    <div>{{ Auth::user()->name }}</div>

                                    <div class="ms-1">
                                        <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                        </svg>
                                    </div>
                                </button>
                            </x-slot>

                            <x-slot name="content">
                                <x-dropdown-link :href="route('profile.edit')">
                                    {{ __('Profile') }}
                                </x-dropdown-link>

                                <!-- Authentication -->
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf

                                    <x-dropdown-link :href="route('logout')"
                                            onclick="event.preventDefault();
                                                        this.closest('form').submit();">
                                        {{ __('Log Out') }}
                                    </x-dropdown-link>
                                </form>
                            </x-slot>
                        </x-dropdown>
                    </div>
        </nav>
        <!-- Mobile menu, show/hide based on menu open state. -->
        <div class="lg:hidden" role="dialog" aria-modal="true">
          <!-- Background backdrop, show/hide based on slide-over state. -->
          <div class="fixed inset-0 z-10"></div>
          <div class="fixed inset-y-0 right-0 z-10 w-full overflow-y-auto bg-white px-6 py-6 sm:max-w-sm sm:ring-1 sm:ring-gray-900/10">
            <div class="flex items-center justify-between">
              <a href="#" class="-m-1.5 p-1.5">
                <span class="sr-only">Your Notification</span>
                <img class="h-8 w-auto" src="https://tailwindui.com/plus/img/logos/mark.svg?color=indigo&shade=600" alt="">
              </a>
              <button type="button" class="-m-2.5 rounded-md p-2.5 text-gray-700">
                <span class="sr-only">Close menu</span>
                <svg class="size-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true" data-slot="icon">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                </svg>
              </button>
            </div>
            <div class="mt-6 flow-root">
              <div class="-my-6 divide-y divide-gray-500/10">
                <div class="space-y-2 py-6">
                  <div class="-mx-3">
                    <button type="button" class="flex w-full items-center justify-between rounded-lg py-2 pl-3 pr-3.5 text-base/7 font-semibold text-gray-900 hover:bg-gray-50" aria-controls="disclosure-1" aria-expanded="false">
                      Product
                      <!--
                        Expand/collapse icon, toggle classes based on menu open state.

                        Open: "rotate-180", Closed: ""
                      -->
                      <svg class="size-5 flex-none" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true" data-slot="icon">
                        <path fill-rule="evenodd" d="M5.22 8.22a.75.75 0 0 1 1.06 0L10 11.94l3.72-3.72a.75.75 0 1 1 1.06 1.06l-4.25 4.25a.75.75 0 0 1-1.06 0L5.22 9.28a.75.75 0 0 1 0-1.06Z" clip-rule="evenodd" />
                      </svg>
                    </button>
                    <!-- 'Product' sub-menu, show/hide based on menu state. -->
                    <div class="mt-2 space-y-2" id="disclosure-1">
                      <a href="#" class="block rounded-lg py-2 pl-6 pr-3 text-sm/7 font-semibold text-gray-900 hover:bg-gray-50">Analytics</a>
                      <a href="#" class="block rounded-lg py-2 pl-6 pr-3 text-sm/7 font-semibold text-gray-900 hover:bg-gray-50">Engagement</a>
                      <a href="#" class="block rounded-lg py-2 pl-6 pr-3 text-sm/7 font-semibold text-gray-900 hover:bg-gray-50">Security</a>
                      <a href="#" class="block rounded-lg py-2 pl-6 pr-3 text-sm/7 font-semibold text-gray-900 hover:bg-gray-50">Integrations</a>
                      <a href="#" class="block rounded-lg py-2 pl-6 pr-3 text-sm/7 font-semibold text-gray-900 hover:bg-gray-50">Automations</a>
                      <a href="#" class="block rounded-lg py-2 pl-6 pr-3 text-sm/7 font-semibold text-gray-900 hover:bg-gray-50">Watch demo</a>
                      <a href="#" class="block rounded-lg py-2 pl-6 pr-3 text-sm/7 font-semibold text-gray-900 hover:bg-gray-50">Contact sales</a>
                    </div>
                  </div>
                  <a href="#" class="-mx-3 block rounded-lg px-3 py-2 text-base/7 font-semibold text-gray-900 hover:bg-gray-50">Resource Managemen</a>{{-- Features --}}
                  <a href="#" class="-mx-3 block rounded-lg px-3 py-2 text-base/7 font-semibold text-gray-900 hover:bg-gray-50">Settings</a>{{-- Marketplace --}}
                  <a href="#" class="-mx-3 block rounded-lg px-3 py-2 text-base/7 font-semibold text-gray-900 hover:bg-gray-50">Notification</a>{{-- COMPANY --}}
                </div>
                <div class="py-6">
                  <a href="#" class="-mx-3 block rounded-lg px-3 py-2.5 text-base/7 font-semibold text-gray-900 hover:bg-gray-50">Log in</a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </header>

      <div class="bg-gray-100 min-h-screen">


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



