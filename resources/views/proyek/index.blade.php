<x-app-layout>
    <x-slot name="title">
        Perencanaan Proyek
    </x-slot>

    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800 leading-tight">
            Modul Perencanaan Proyek
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Form Membuat Proyek Baru -->
            <section class="bg-white shadow-md rounded-lg mb-6">
                <header class="bg-blue-600 text-white p-4 rounded-t-lg">
                    <h5 class="text-lg font-semibold">Buat Proyek Baru</h5>
                </header>
                <div class="p-4">
                    <form>
                        <label for="project-title" class="block mb-2 text-sm font-medium text-gray-700">Judul Proyek</label>
                        <input type="text" id="project-title"
                            class="w-full p-2 border border-gray-300 rounded focus:ring-blue-500 focus:border-blue-500"
                            placeholder="Masukkan judul proyek" required>

                        <label for="project-desc" class="block mt-4 mb-2 text-sm font-medium text-gray-700">Deskripsi</label>
                        <textarea id="project-desc" rows="6"
                            class="w-full p-2 border border-gray-300 rounded focus:ring-blue-500 focus:border-blue-500"
                            placeholder="Masukkan deskripsi proyek" required></textarea>

                        <label for="project-budget" class="block mt-4 mb-2 text-sm font-medium text-gray-700">Anggaran</label>
                        <input type="number" id="project-budget"
                            class="w-full p-2 border border-gray-300 rounded focus:ring-blue-500 focus:border-blue-500"
                            placeholder="Masukkan anggaran" required>

                        <label for="project-resource" class="block mt-4 mb-2 text-sm font-medium text-gray-700">Sumber Daya</label>
                        <input type="text" id="project-resource"
                            class="w-full p-2 border border-gray-300 rounded focus:ring-blue-500 focus:border-blue-500"
                            placeholder="Masukkan sumber daya (contoh: Tenaga Kerja, Material, Peralatan)" required>

                        <label for="resource-quantity" class="block mt-4 mb-2 text-sm font-medium text-gray-700">Kuantitas Sumber Daya</label>
                        <input type="number" id="resource-quantity"
                            class="w-full p-2 border border-gray-300 rounded focus:ring-blue-500 focus:border-blue-500"
                            placeholder="Masukkan jumlah" required>

                        <!-- Project Detail Section -->
                        <section class="mt-6">
                            <p class="font-semibold text-gray-700">Detail Proyek</p>
                            <button class="toggle-detail-btn w-full px-4 py-2 mt-2 text-white bg-blue-500 rounded hover:bg-blue-600"
                                type="button">Lihat Detail Proyek</button>

                            <div class="project-detail-card hidden mt-4">
                                <label for="start-date" class="block mb-2 text-sm font-medium text-gray-700">Tanggal Mulai</label>
                                <input type="date" id="start-date"
                                    class="w-full p-2 border border-gray-300 rounded focus:ring-blue-500 focus:border-blue-500"
                                    required>

                                <label for="end-date" class="block mt-4 mb-2 text-sm font-medium text-gray-700">Tanggal Selesai</label>
                                <input type="date" id="end-date"
                                    class="w-full p-2 border border-gray-300 rounded focus:ring-blue-500 focus:border-blue-500"
                                    required>

                                <label for="new-task" class="block mt-4 mb-2 text-sm font-medium text-gray-700">Tugas Baru</label>
                                <textarea id="new-task" rows="4"
                                    class="w-full p-2 border border-gray-300 rounded focus:ring-blue-500 focus:border-blue-500"
                                    placeholder="Masukkan tugas baru" required></textarea>

                                <button type="submit"
                                    class="w-full mt-4 px-4 py-2 text-white bg-blue-600 rounded hover:bg-blue-700">Simpan Detail</button>
                            </div>
                        </section>

                        <label for="project-status" class="block mt-4 mb-2 text-sm font-medium text-gray-700">Status</label>
                        <select id="project-status"
                            class="w-full p-2 border border-gray-300 rounded focus:ring-blue-500 focus:border-blue-500">
                            <option value="planned">Planned</option>
                            <option value="ongoing">Ongoing</option>
                            <option value="completed">Completed</option>
                        </select>

                        <label for="project-creator" class="block mt-4 mb-2 text-sm font-medium text-gray-700">Dibuat Oleh</label>
                        <input type="text" id="project-creator"
                            class="w-full p-2 border border-gray-300 rounded focus:ring-blue-500 focus:border-blue-500"
                            placeholder="Masukkan nama pembuat" required>

                        <button type="submit"
                            class="w-full mt-4 px-4 py-2 text-white bg-blue-600 rounded hover:bg-blue-700">Buat Proyek</button>
                    </form>
                </div>
            </section>
        </div>
    </div>

    <script>
        // Toggle Visibility of Project Detail Card
        document
            .querySelector(".toggle-detail-btn")
            .addEventListener("click", function () {
                const detailCard = document.querySelector(".project-detail-card");
                detailCard.classList.toggle("hidden");

                // Update button text based on visibility
                this.textContent = detailCard.classList.contains("hidden")
                    ? "Lihat Detail Proyek"
                    : "Tutup Detail Proyek";
            });
    </script>
</x-app-layout>
