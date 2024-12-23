<x-app-layout>
    <!-- Slot untuk title halaman -->
    <x-slot name="title">
        Manajemen Sumber Daya
    </x-slot>

    <!-- Header halaman -->
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            Modul Manajemen Sumber Daya
        </h2>
    </x-slot>

    @if (session('success'))
        <div class="p-4 mb-4 text-sm text-green-700 bg-green-100 rounded">
            {{ session('success') }}
        </div>
    @endif

    @php
        $type = request()->get('type');
    @endphp

    <!-- Bagian konten utama halaman -->
    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <!-- Search and Filter -->
            <form method="GET" action="{{ route('ManajemenSD.index') }}" class="flex items-center mb-6 space-x-4">
                <input type="text" name="search" placeholder="Cari Sumber Daya..." value="{{ request('search') }}"
                    class="w-full p-2 border border-gray-300 rounded focus:ring-blue-500 focus:border-blue-500">
                <button type="submit" class="px-4 py-2 text-white bg-blue-600 rounded hover:bg-blue-700">
                    Cari
                </button>
            </form>

            <div class="flex flex-wrap justify-center gap-2 p-4 rounded-md shadow-sm" role="group">
                <a type="button" href="?type=tenaga_kerja"
                    class="px-4 py-2 text-sm font-medium text-center 
        {{ $type == 'tenaga_kerja' ? 'rounded-full text-white bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 hover:bg-green-900' : 'text-green-700 border border-green-700 rounded-full hover:text-white hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300' }}">
                    Tenaga Kerja
                </a>
                <a type="button" href="?type=material"
                    class="px-4 py-2 text-sm font-medium text-center 
        {{ $type == 'material' || $type == null ? 'rounded-full text-white bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 hover:bg-green-900' : 'text-green-700 border border-green-700 rounded-full hover:text-white hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300' }}">
                    Material
                </a>
            </div>

            @if ($type == 'tenaga_kerja')
                @include('ManajemenSD.tenagakerja')
            @else
                @include('ManajemenSD.material')
            @endif
        </div>
    </div>

    <!-- Modal Toggle Script -->
    <script>
        function toggleModal(show) {
            const modal = document.getElementById('modal');
            modal.classList.toggle('hidden', !show);
        }

        function toggleDetailModal(show) {
            const modal = document.getElementById('detailModal');
            modal.classList.toggle('hidden', !show);
        }

        function showDetailModal(resource) {
            document.getElementById('detailName').textContent = resource.name;
            document.getElementById('detailType').textContent = resource.type;
            document.getElementById('detailQuantity').textContent = resource.quantity;
            document.getElementById('detailStatus').textContent = resource.status;
            toggleDetailModal(true);
        }



        function validateForm() {
            const sumberDayaDropdown = document.getElementById('sumber_daya_id');
            const selectedOption = sumberDayaDropdown.options[sumberDayaDropdown.selectedIndex];

            if (!selectedOption || selectedOption.getAttribute('data-status') === 'Not Available') {
                alert('Sumber daya yang dipilih tidak tersedia.');
                return false;
            }

            return true;
        }
    </script>
</x-app-layout>
