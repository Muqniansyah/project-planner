<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Settings') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <h1 class="text-3xl font-bold leading-tight text-center text-gray-800">Pengaturan Sistem</h1>
                    <h2 class="text-lg font-semibold leading-tight text-gray-800">
                        Manajemen Pengguna & Hak Akses
                    </h2>
                    <hr class="h-1 my-4 bg-blue-500">


                    <form class="max-w-sm">
                        <div class="mb-5">
                            <label for="name" class="block mb-2 text-sm font-medium text-gray-900 ">Nama
                                Pengguna</label>
                            <select id="name" name="name"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 ">
                                <option value="akun1">Akun 1</option>
                                <option value="akun2">Akun 2</option>
                            </select>
                        </div>
                        <div class="mb-5">
                            <p class="block mb-2 text-xl font-bold text-gray-900">Hak
                                Akses</p>

                            <div class="flex items-center mb-4">
                                <input checked id="read" type="checkbox" value="" name="hakAkses"
                                    class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500">
                                <label for="read" class="text-sm font-medium text-gray-900 ms-2">Read</label>
                            </div>

                            <div class="flex items-center mb-4">
                                <input checked id="create" type="checkbox" value="" name="hakAkses"
                                    class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500">
                                <label for="create" class="text-sm font-medium text-gray-900 ms-2">Create</label>
                            </div>

                            <div class="flex items-center mb-4">
                                <input checked id="update" type="checkbox" value="" name="hakAkses"
                                    class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500">
                                <label for="update" class="text-sm font-medium text-gray-900 ms-2">Update</label>
                            </div>

                            <div class="flex items-center mb-4">
                                <input checked id="delete" type="checkbox" value="" name="hakAkses"
                                    class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500">
                                <label for="delete" class="text-sm font-medium text-gray-900 ms-2">Delete</label>
                            </div>

                        </div>
                        <button type="submit"
                            class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5">Submit</button>
                    </form>


                </div>
            </div>
        </div>
    </div>
</x-app-layout>
