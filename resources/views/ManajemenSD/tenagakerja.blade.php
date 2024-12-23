<!-- Resource Table -->
<section class="mb-6 bg-white rounded-lg shadow-md">
    <header class="flex items-center justify-between p-4 text-white bg-blue-600 rounded-t-lg">
        <h5 class="text-lg font-semibold">Pemantauan Ketersediaan Sumber Daya</h5>
        @if (Auth::user()->role === 'admin')
            <button class="px-4 py-2 text-white bg-green-600 rounded hover:bg-green-700" onclick="toggleModal(true)">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd"
                        d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z"
                        clip-rule="evenodd" />
                </svg>
            </button>
        @endif
    </header>
    <div class="p-4">
        <table class="min-w-full border border-gray-200 rounded-lg table-auto">
            <thead>
                <tr class="bg-blue-100">
                    <th class="px-4 py-2 text-sm font-semibold text-left text-gray-800">Nama Sumber Daya
                    </th>
                    <th class="px-4 py-2 text-sm font-semibold text-left text-gray-800">Jenis</th>
                    <th class="px-4 py-2 text-sm font-semibold text-left text-gray-800">Kuantitas</th>
                    <th class="px-4 py-2 text-sm font-semibold text-left text-gray-800">Aksi</th>
                    <th class="px-4 py-2 text-sm font-semibold text-left text-gray-800">Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($tenaga_kerja as $resource)
                    <tr class="border-b">
                        <td class="px-4 py-2 text-gray-700">{{ $resource->name }}</td>
                        <td class="px-4 py-2 text-gray-700">{{ $resource->type }}</td>
                        <td class="px-4 py-2 text-gray-700">{{ $resource->quantity }}</td>
                        <td class="flex px-4 py-2 space-x-2">
                            <!-- Edit button -->
                            <a href="{{ route('ManajemenSD.edit', $resource->id) }}"
                                class="text-yellow-500 hover:text-yellow-600">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 20 20"
                                    fill="currentColor">
                                    <path fill-rule="evenodd"
                                        d="M12.854 2.146a2 2 0 00-2.828 0l-8 8a2 2 0 00-.477.793l-2 7a1 1 0 001.209 1.209l7-2a2 2 0 00.793-.477l8-8a2 2 0 000-2.828l-2.828-2.828a2 2 0 00-2.828 0l-4.242 4.242a1 1 0 00-.293.707v4h-3V8.707a1 1 0 00-.293-.707L12.854 2.146z"
                                        clip-rule="evenodd" />
                                </svg>
                            </a>
                            <!-- show button -->
                            <a href="#" onclick="showDetailModal({{ json_encode($resource) }})"
                                class="text-blue-500 hover:text-blue-600">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 20 20"
                                    fill="currentColor">
                                    <path fill-rule="evenodd"
                                        d="M15.75 13.75l-3.62-3.62a6.5 6.5 0 10-1.13 1.13L13.75 15.75a1 1 0 001.5-1.32l-.5-.5a8 8 0 111.25-1.35z"
                                        clip-rule="evenodd" />
                                </svg>
                            </a>
                        </td>
                        <td class="px-4 py-2 text-gray-700">
                            @if ($resource->status === 'Available')
                                <span class="px-2 py-1 text-green-700 bg-green-100 rounded">Available</span>
                            @else
                                <span class="px-2 py-1 text-red-700 bg-red-100 rounded">Not
                                    Available</span>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</section>
<!-- Pagination -->
<div class="flex justify-center mt-4 mb-4">
    {{ $tenaga_kerja->appends(request()->query())->links() }}
</div>

@if (Auth::user()->role === 'manager')
    <!-- Allocation Form -->
    <section class="mb-6 bg-white rounded-lg shadow-md">
        <header class="p-4 text-white bg-blue-600 rounded-t-lg">
            <h5 class="text-lg font-semibold">Alokasi Sumber Daya</h5>
        </header>
        <div class="p-4">
            <form action="{{ route('ManajemenSD.storeAllocation') }}" method="POST" onsubmit="return validateForm()">
                @csrf
                <!-- Pilih Job Desk -->
                <div class="mb-4">
                    <label for="sumber_daya_id" class="block mb-2 text-sm font-medium text-gray-700">
                        Job Desk :
                    </label>
                    <select id="sumber_daya_id" name="sumber_daya_id"
                        class="w-full p-2 border border-gray-300 rounded focus:ring-blue-500 focus:border-blue-500"
                        required onchange="updateResourceInfo(); updateUserOptions()">
                        @foreach ($tenaga_kerja as $resource)
                            @if ($resource->status === 'Available')
                                <option value="{{ $resource->id }}" data-quantity="{{ $resource->quantity }}"
                                    data-type="{{ $resource->type }}" data-users="{{ json_encode($resource->users) }}">
                                    {{ $resource->name }}
                                </option>
                            @endif
                        @endforeach
                    </select>
                </div>

                <!-- Pilih Proyek -->
                <div class="mb-4">
                    <label for="project_id" class="block mb-2 text-sm font-medium text-gray-700">
                        Proyek:
                    </label>
                    <select id="project_id" name="project_id"
                        class="w-full p-2 border border-gray-300 rounded focus:ring-blue-500 focus:border-blue-500"
                        required>
                        <option value="">Pilih Proyek</option>
                        @foreach ($projects as $project)
                            <option value="{{ $project->id }}">{{ $project->name }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Jenis -->
                <div class="mb-4">
                    <label for="jenis" class="block mb-2 text-sm font-medium text-gray-700">
                        Jenis Sumber Daya:
                    </label>
                    <input type="text" id="jenis" name="jenis"
                        class="w-full p-2 bg-gray-100 border border-gray-300 rounded cursor-not-allowed focus:ring-0"
                        disabled required>
                </div>

                <!-- Pilih User -->
                <div class="mb-4">
                    <label for="user_id" class="block mb-2 text-sm font-medium text-gray-700">
                        User :
                    </label>
                    <select id="user_id" name="user"
                        class="w-full p-2 border border-gray-300 rounded focus:ring-blue-500 focus:border-blue-500"
                        required>
                        <option value="">Pilih User</option>
                        <!-- User options will be dynamically populated here -->
                    </select>
                </div>

                <!-- Tombol -->
                <button type="submit" class="w-full px-4 py-2 text-white bg-blue-600 rounded hover:bg-blue-700">
                    Alokasikan
                </button>
            </form>
        </div>
    </section>
@endif

<!-- Detail Modal Box -->
<div id="detailModal" class="fixed inset-0 flex items-center justify-center hidden bg-gray-900 bg-opacity-50">
    <div class="bg-white rounded-lg shadow-lg w-96">
        <header class="flex items-center justify-between p-4 text-white bg-blue-600 rounded-t-lg">
            <h5 class="text-lg font-semibold">Detail Sumber Daya</h5>
            <button onclick="toggleDetailModal(false)" class="text-white">&times;</button>
        </header>
        <div class="p-4">
            <p class="mb-2"><strong>Nama:</strong> <span id="detailName"></span></p>
            <p class="mb-2"><strong>Jenis:</strong> <span id="detailType"></span></p>
            <p class="mb-2"><strong>Kuantitas:</strong> <span id="detailQuantity"></span></p>
            <p class="mb-2"><strong>Status:</strong> <span id="detailStatus"></span></p>
        </div>
    </div>
</div>

<!-- Tambah Modal Box -->
<div id="modal" class="fixed inset-0 flex items-center justify-center hidden bg-gray-900 bg-opacity-50">
    <div class="bg-white rounded-lg shadow-lg w-96">
        <header class="flex items-center justify-between p-4 text-white bg-blue-600 rounded-t-lg">
            <h5 class="text-lg font-semibold">Tambah Sumber Daya</h5>
            <button onclick="toggleModal(false)" class="text-white">&times;</button>
        </header>
        <div class="p-4">
            <form action="{{ route('ManajemenSD.store') }}" method="POST">
                @csrf
                <!-- Nama Sumber Daya -->
                <div class="mb-4">
                    <label for="name" class="block mb-2 text-sm font-medium text-gray-700">
                        Nama :
                    </label>
                    <input type="text" id="name" name="name"
                        class="w-full p-2 border border-gray-300 rounded focus:ring-blue-500 focus:border-blue-500"
                        required>
                </div>

                <!-- Jenis -->
                <div class="mb-4">
                    <label for="type" class="block mb-2 text-sm font-medium text-gray-700">
                        Jenis:
                    </label>
                    <select id="type" name="type"
                        class="w-full p-2 border border-gray-300 rounded focus:ring-blue-500 focus:border-blue-500"
                        required>
                        <option value="Tenaga Kerja">Tenaga Kerja</option>
                    </select>
                </div>

                <!-- Tombol -->
                <button type="submit" class="w-full px-4 py-2 text-white bg-green-600 rounded hover:bg-green-700">
                    Tambah
                </button>
            </form>
        </div>
    </div>
</div>

<script>
    function updateResourceInfo() {
        const sumberDayaDropdown = document.getElementById('sumber_daya_id');
        const selectedOption = sumberDayaDropdown.options[sumberDayaDropdown.selectedIndex];

        // Ambil data dari atribut data-quantity dan data-type
        const type = selectedOption.getAttribute('data-type');

        // Update nilai input
        document.getElementById('jenis').value = type || '';

        // Aktifkan atau tetap disabled
        document.getElementById('jenis').disabled = true;
    }

    function updateUserOptions() {
        const selectedOption = document.getElementById('sumber_daya_id').selectedOptions[0];
        const userSelect = document.getElementById('user_id');

        if (!selectedOption) {
            console.error("Job desk selection is invalid.");
            userSelect.innerHTML = '<option value="">Pilih User</option>';
            return;
        }

        // Get users from the data-users attribute
        const usersData = JSON.parse(selectedOption.getAttribute('data-users') || '[]');

        // Clear existing options
        userSelect.innerHTML = '<option value="">Pilih User</option>';

        // Populate new options
        usersData.forEach(user => {
            const option = document.createElement('option');
            option.value = user.id;
            option.textContent = user.name;
            userSelect.appendChild(option);
        });


    }
</script>
