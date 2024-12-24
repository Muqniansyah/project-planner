<x-app-layout>
    <div class="py-6 mx-auto max-w-7xl sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3">
            <!-- Card User -->
            <div class="overflow-hidden bg-white rounded-lg shadow-lg">
                <div class="p-6 text-center">
                    <h2 class="text-xl font-semibold text-gray-800">User</h2>
                    <p class="mt-2 text-gray-600">Manage users in your application</p>
                    <a href="{{ route('admin.user.create') }}" class="inline-block px-4 py-2 mt-4 text-white bg-blue-500 rounded-lg hover:bg-blue-600">Go to User</a>
                </div>
            </div>

            <!-- Card Project -->
            <div class="overflow-hidden bg-white rounded-lg shadow-lg">
                <div class="p-6 text-center">
                    <h2 class="text-xl font-semibold text-gray-800">Project</h2>
                    <p class="mt-2 text-gray-600">Manage your projects and tasks</p>
                    <a href="{{ route('proyek.index') }}" class="inline-block px-4 py-2 mt-4 text-white bg-green-500 rounded-lg hover:bg-green-600">Go to Project</a>
                </div>
            </div>

            <!-- Card Sumberdaya -->
            <div class="overflow-hidden bg-white rounded-lg shadow-lg">
                <div class="p-6 text-center">
                    <h2 class="text-xl font-semibold text-gray-800">Sumberdaya</h2>
                    <p class="mt-2 text-gray-600">Manage your resources effectively</p>
                    <a href="{{ route('ManajemenSD.index') }}" class="inline-block px-4 py-2 mt-4 text-white bg-yellow-500 rounded-lg hover:bg-yellow-600">Go to Sumberdaya</a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
