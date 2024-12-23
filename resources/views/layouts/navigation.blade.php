

    <!-- Navbar -->
    <nav class="bg-gray-800">
        <div class="px-2 mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="relative flex items-center justify-between h-16">
                <div class="absolute inset-y-0 left-0 flex items-center sm:hidden">
                    <!-- Mobile menu button -->
                    <button type="button"
                        class="relative inline-flex items-center justify-center p-2 text-gray-400 rounded-md hover:bg-gray-700 hover:text-white focus:outline-none focus:ring-2 focus:ring-inset focus:ring-white"
                        aria-controls="mobile-menu" aria-expanded="false">
                        <span class="absolute -inset-0.5"></span>
                        <span class="sr-only">Open main menu</span>
                        <!-- Icon when menu is closed -->
                        <svg class="block w-6 h-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" aria-hidden="true" data-slot="icon">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                        </svg>
                        <!-- Icon when menu is open -->
                        <svg class="hidden w-6 h-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" aria-hidden="true" data-slot="icon">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
                <div class="flex items-center justify-center flex-1 sm:items-stretch sm:justify-start">
                    <div class="flex items-center shrink-0">
                        <div class="logo">
                            <i class="text-2xl text-blue-500 fas fa-tasks"></i>
                        </div>
                    </div>
                    <div class="hidden sm:flex sm:items-stretch sm:m-auto">
                        <div class="flex space-x-4">
                            <a href="{{ route('dashboard') }}" class="px-3 py-2 text-sm font-medium  rounded-md {{ Request::is('dashboard*') ? 'text-white bg-gray-900' : 'text-gray-300 hover:bg-gray-700 hover:text-white' }}"
                                aria-current="page">Dashboard</a>
                            <a href="{{ route('proyek.index') }}"
                                class="px-3 py-2 text-sm font-medium {{ Request::is('proyek*') || Request::is('Laporan*') ? 'text-white bg-gray-900' : 'text-gray-300 hover:bg-gray-700 hover:text-white' }} rounded-md">Project</a>
                            <a href="{{ route('ManajemenSD.index') }}"
                                class="px-3 py-2 text-sm font-medium {{ Request::is('ManajemenSD*') ? 'text-white bg-gray-900' : 'text-gray-300 hover:bg-gray-700 hover:text-white' }} rounded-md">Resource
                                Management</a>
                        </div>
                    </div>
                </div>
                <div class="absolute inset-y-0 right-0 flex items-center pr-2 sm:static sm:inset-auto sm:ml-6 sm:pr-0">
                    <div class="relative">
                        <button type="button" id="notification-menu-button"
                            class="relative p-1 text-gray-400 bg-gray-800 rounded-full hover:text-white focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-gray-800">
                            <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M14.857 17.082a23.848 23.848 0 0 0 5.454-1.31A8.967 8.967 0 0 1 18 9.75V9A6 6 0 0 0 6 9v.75a8.967 8.967 0 0 1-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 0 1-5.714 0m5.714 0a3 3 0 1 1-5.714 0" />
                            </svg>
                            <!-- Badge untuk jumlah notifikasi -->
                            @if(isset($notifications) && $notifications->isNotEmpty())
                            <span class="absolute top-0 right-0 flex items-center justify-center w-4 h-4 text-xs text-white bg-red-500 rounded-full">
                                {{ $notifications->count() }}
                            </span>
                            @endif
                        </button>
                        <div id="notification-menu"
                            class="absolute right-0 z-10 hidden w-64 mt-2 bg-white rounded-md shadow-lg ring-1 ring-black/5 focus:outline-none">
                            <div class="py-2 bg-white rounded-lg shadow-lg">
                                <!-- Header -->
                                <div class="px-4 py-2 bg-gray-100 border-b rounded-t-lg">
                                    <h3 class="text-sm font-semibold text-gray-700">View Notifications</h3>
                                </div>
                                <hr>
                                <!-- Notifications -->
                                <div class="overflow-y-auto max-h-64">
                                    @if(isset($notifications) && $notifications->isNotEmpty())
                                    @foreach($notifications as $notification)
                                    <div class="px-4 py-3 text-sm border-b hover:bg-gray-50 last:border-none">
                                        <div>
                                            <h4 class="font-semibold text-gray-800">{{ $notification->data['title'] }}</h4>
                                            <p class="text-gray-600">{{ $notification->data['message'] }}</p>
                                        </div>
                                        <div class="flex items-center justify-between mt-2">
                                            @if(!empty($notification->data['url']))
                                            <a href="{{ $notification->data['url'] }}" class="text-sm text-blue-500 hover:underline">Lihat detail</a>
                                            @endif
                                            <small class="text-xs text-gray-500">{{ $notification->created_at->diffForHumans() }}</small>
                                        </div>
                                    </div>
                                    @endforeach
                                    @else
                                    <p class="px-4 py-3 text-sm text-center text-gray-600">Tidak ada notifikasi</p>
                                    @endif
                                </div>
                                <!-- Footer -->
                                <div class="px-4 py-2 bg-gray-100 border-t rounded-b-lg">
                                    <button class="w-full px-4 py-2 text-sm text-white bg-blue-600 rounded hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500">
                                        Tandai Semua Dibaca
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Profile dropdown -->
                    <div class="relative ml-3">
                        <div>
                            <button type="button"
                                class="relative flex text-sm bg-gray-800 rounded-full focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-gray-800"
                                id="user-menu-button" aria-expanded="false" aria-haspopup="true">
                                <span class="absolute -inset-1.5"></span>
                                <span class="sr-only">Open user menu</span>
                                <img class="w-8 h-8 rounded-full"
                                    src="{{ Auth::user()->photo == null ? asset('images/user/default.png') : asset('storage/' . Auth::user()->photo) }}"
                                    alt="">
                            </button>
                        </div>

                        <div class="absolute right-0 z-10 hidden w-48 py-1 mt-2 origin-top-right bg-white rounded-md shadow-lg ring-1 ring-black/5 focus:outline-none"
                            role="menu" aria-orientation="vertical" aria-labelledby="user-menu-button"
                            tabindex="-1">
                            <p class="px-4 py-2 text-sm font-semibold text-gray-700">{{ Auth::user()->name }}</p>
                            <hr class="border-gray-500 border-1">
                            <a href="{{ route('profile.edit') }}" class="block px-4 py-2 text-sm text-gray-700" role="menuitem"
                                tabindex="-1" id="user-menu-item-0">Your Profile</a>
                            <a href="{{ route('settings.index') }}" class="block px-4 py-2 text-sm text-gray-700"
                                role="menuitem" tabindex="-1" id="user-menu-item-1">Settings</a>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="block px-4 py-2 text-sm text-gray-700" role="menuitem"
                                    tabindex="-1" id="user-menu-item-2">Sign out</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Mobile menu -->
        <div class="hidden sm:hidden" id="mobile-menu">
            <div class="px-2 pt-2 pb-3 space-y-1">
                <a href="#" class="block px-3 py-2 text-base font-medium text-white bg-gray-900 rounded-md"
                    aria-current="page">Dashboard</a>
                <a href="{{ route('proyek.index') }}"
                    class="block px-3 py-2 text-base font-medium text-gray-300 rounded-md hover:bg-gray-700 hover:text-white">Projects</a>
                <a href="{{ route('ManajemenSD.index') }}"
                    class="block px-3 py-2 text-base font-medium text-gray-300 rounded-md hover:bg-gray-700 hover:text-white">Resource
                    Management</a>
            </div>
        </div>
    </nav>

    <!-- JavaScript -->
    <script>
        // DOM Elements
        const userMenuButton = document.getElementById('user-menu-button');
        const userMenu = document.querySelector('[aria-labelledby="user-menu-button"]');
        const mobileMenuButton = document.querySelector('[aria-controls="mobile-menu"]');
        const mobileMenu = document.getElementById('mobile-menu');

        // Function to toggle user dropdown menu
        const toggleUserMenu = () => {
            const isExpanded = userMenuButton.getAttribute('aria-expanded') === 'true';
            userMenuButton.setAttribute('aria-expanded', !isExpanded);
            userMenu.classList.toggle('hidden'); // Show/hide menu
        };

        // Function to toggle mobile navbar menu
        const toggleMobileMenu = () => {
            const isExpanded = mobileMenuButton.getAttribute('aria-expanded') === 'true';
            mobileMenuButton.setAttribute('aria-expanded', !isExpanded);
            mobileMenu.classList.toggle('hidden'); // Show/hide menu
        };

        // Close menu when clicking outside
        document.addEventListener('click', (event) => {
            if (!userMenu.contains(event.target) && !userMenuButton.contains(event.target)) {
                userMenu.classList.add('hidden'); // Close user menu
            }
            if (!mobileMenu.contains(event.target) && !mobileMenuButton.contains(event.target)) {
                mobileMenu.classList.add('hidden'); // Close mobile menu
            }
        });

        // Event Listeners
        userMenuButton.addEventListener('click', toggleUserMenu);
        mobileMenuButton.addEventListener('click', toggleMobileMenu);

        // notification
        const notificationMenuButton = document.getElementById('notification-menu-button');
        const notificationMenu = document.getElementById('notification-menu');

        // Toggle dropdown menu
        notificationMenuButton.addEventListener('click', () => {
            notificationMenu.classList.toggle('hidden');
        });

        // Close menu jika klik di luar
        document.addEventListener('click', (event) => {
            if (!notificationMenu.contains(event.target) && !notificationMenuButton.contains(event.target)) {
                notificationMenu.classList.add('hidden');
            }
        });
    </script>

