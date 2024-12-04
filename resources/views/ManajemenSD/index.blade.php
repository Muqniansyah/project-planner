    {{-- Memasukkan bagian navigasi utama --}}
    {{-- @include('navigasiutama') --}}

    <!-- Slot untuk title halaman-->
    <x-slot name="title ">
        Manajemen Sumber Daya
    </x-slot>

    {{-- Judul Halaman --}}
    <div class="Judul p-4 border bg-[#387ADF] rounded font-[PoltawskiNowy] text-white ">
        <h1 class="text-center"> Manajemen Sumber Daya</h1>
    </div>

    <!-- Slot untuk header halaman -->
        <!-- Tailwind CSS CDN -->
        <script src="https://cdn.tailwindcss.com"></script>

        {{-- Google Font --}}
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Poltawski+Nowy:ital,wght@0,400..700;1,400..700&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">        <!-- Bootstrap CSS CDN -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">



        <!-- Slot title dari aplikasi -->
        <x-slot name="title">
            Manajemen Sumber Daya
        </x-slot>

    <x-slot name="header">

        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Modul Manajemen Sumber Daya
        </h2>
    </x-slot>

    <!-- Bagian konten utama halaman -->
    <div class="py-12">
        <!-- Kontainer utama untuk menyusun konten secara responsif -->
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <!-- Summary Stats: Menampilkan ringkasan data sumber daya -->
            {{-- <div class="row mb-4"> --}}
                <!-- Kartu untuk menampilkan total tenaga kerja -->
                {{-- <div class="col-md-4">
                    <div class="card text-center p-3">
                        <h5>Total Tenaga Kerja</h5>
                        <h3>35 Orang</h3>
                    </div>
                </div> --}}

                <!-- Kartu untuk menampilkan total material -->
                {{-- <div class="col-md-4">
                    <div class="card text-center p-3">
                        <h5>Total Material</h5>
                        <h3>120 Unit</h3>
                    </div>
                </div> --}}

                <!-- Kartu untuk menampilkan persentase sumber daya yang tersedia -->
                {{-- <div class="col-md-4">
                    <div class="card text-center p-3">
                        <h5>Sumber Daya Tersedia</h5>
                        <h3>80%</h3>
                    </div>
                </div>
            </div> --}}

            <!-- Resource Table: Tabel untuk menampilkan data sumber daya yang tersedia -->
            <div class="card mb-4">
                <div class="card-header bg-primary text-white">
                    <h5>Pemantauan Ketersediaan Sumber Daya</h5>
                </div>
                <div class="card-body">
                    <!-- Tabel untuk menampilkan daftar sumber daya -->
                    <table class="table table-bordered table-striped">
                        <thead class="table-primary">
                            <tr>
                                <th>Nama Sumber Daya</th> <!-- Nama sumber daya -->
                                <th>Jenis</th> <!-- Jenis sumber daya -->
                                <th>Kuantitas</th> <!-- Kuantitas sumber daya -->
                                <th>Aksi</th> <!-- Status ketersediaan -->
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Baris data sumber daya yang pertama -->
                            <tr>
                                <td>Tenaga Kerja A</td> <!-- Nama sumber daya -->
                                <td>Tenaga Kerja</td> <!-- Jenis sumber daya -->
                                <td>10 Orang</td> <!-- Kuantitas -->
                                <td><button class="btn btn-sm" style="background-color: #ffa600; color: rgb(0, 0, 0);">Edit</button></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Allocation Form: Formulir untuk alokasi sumber daya baru -->
            <div class="card mb-4">
                <div class="card-header bg-primary text-white">
                    <h5>Alokasi Sumber Daya</h5>
                </div>
                <div class="card-body">
                    <!-- Formulir alokasi -->
                    <form action="#" method="POST">
                        @csrf <!-- Cross-Site Request Forgery protection token -->

                        <!-- Input untuk nama sumber daya -->
                        <div class="mb-3">
                            <label for="resourceName" class="form-label">Nama Sumber Daya:</label>
                            <input type="text" class="form-control" id="resourceName" name="resource_name" required>
                        </div>

                        <!-- Input untuk memilih jenis sumber daya -->
                        <div class="mb-3">
                            <label for="resourceType" class="form-label">Jenis:</label>
                            {{-- <select class="form-select" id="resourceType" name="resource_type" required>
                                <option value="">Pilih Jenis</option> <!-- Pilihan kosong untuk user memilih -->
                                <option value="Tenaga Kerja">Tenaga Kerja</option> <!-- Pilihan Tenaga Kerja -->
                                <option value="Material">Material</option> <!-- Pilihan Material -->
                            </select> --}}
                            <select class="form-select" id="resourceType" name="resource_type" required>
                                <option value="Material">Material</option> <!-- Hanya Material -->
                            </select>

                        </div>

                        <!-- Input untuk kuantitas sumber daya -->
                        <div class="mb-3">
                            <label for="quantity" class="form-label">Kuantitas:</label>
                            <input type="number" class="form-control" id="quantity" name="quantity" required>
                        </div>

                        <!-- Tombol untuk mengirimkan formulir -->
                        <button type="submit" class="btn btn-primary">Alokasikan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
