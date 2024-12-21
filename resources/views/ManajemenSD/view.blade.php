<x-app-layout>
    <x-slot name="title">
        Sumber Daya Proyek
    </x-slot>

    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800 leading-tight">
            Sumber Daya Proyek
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Daftar Sumber Daya -->
            <section class="bg-white shadow-md rounded-lg mb-6">
                <header class="bg-blue-600 text-white p-4 rounded-t-lg">
                    <h5 class="text-lg font-semibold">Daftar Sumber Daya</h5>
                </header>
                <div class="p-4 overflow-x-auto">
                    <table class="min-w-full border border-gray-200 rounded-lg">
                        <thead>
                            <tr class="bg-blue-100">
                                <th class="px-4 py-2 text-left text-sm font-semibold text-gray-800">Nama Sumber Daya</th>
                                <th class="px-4 py-2 text-left text-sm font-semibold text-gray-800">Jenis Sumber Daya</th>
                                <th class="px-4 py-2 text-left text-sm font-semibold text-gray-800">Jenis</th>
                                <th class="px-4 py-2 text-left text-sm font-semibold text-gray-800">Kuantitas</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach ($allocations as $allocation)
                            <tr>
                                <td class="px-4 py-2">{{ $allocation->project->name }}</td>
                                <td class="px-4 py-2">{{ $allocation->sumberDaya->name }}</td>
                                <td class="px-4 py-2">{{ $allocation->jenis }}</td> 
                                <td class="px-4 py-2">{{ $allocation->quantity }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </section>
        </div>
    </div>
</x-app-layout>
