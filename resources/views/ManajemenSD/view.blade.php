@extends('proyek.detail')

@section('content')
    <x-slot name="title">
        Sumber Daya Proyek
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <!-- Daftar Sumber Daya -->
            <section class="mb-6 bg-white rounded-lg shadow-md">
                <header class="p-4 text-white bg-blue-600 rounded-t-lg">
                    <h5 class="text-lg font-semibold">Daftar Sumber Daya {{ $project->name }}</h5>
                </header>
                <div class="p-4 overflow-x-auto">
                    <table class="min-w-full border border-gray-200 rounded-lg">
                        <thead>
                            <tr class="bg-blue-100">
                                <th class="px-4 py-2 text-sm font-semibold text-left text-gray-800">Nama Sumber Daya</th>
                                <th class="px-4 py-2 text-sm font-semibold text-left text-gray-800">Jenis</th>
                                <th class="px-4 py-2 text-sm font-semibold text-left text-gray-800">Kuantitas</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($allocations as $allocation)
                                <tr>
                                    <td class="px-4 py-2">{{ $allocation->sumberDaya->name }}</td>
                                    <td class="px-4 py-2">{{ $allocation->jenis }}</td>
                                    <td class="px-4 py-2">{{ $allocation->quantity }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" class="px-4 py-2 text-center">Tidak ada sumber daya untuk proyek ini.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </section>
        </div>
    </div>
@endsection
