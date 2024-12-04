<?php
// Simpan laporan dalam array (simulasi database)
session_start();

// Inisialisasi laporan jika belum ada
if (!isset($_SESSION['laporan'])) {
    $_SESSION['laporan'] = [
        [
            'judul' => 'Laporan Proyek A',
            'penulis' => 'John Doe',
            'tanggal' => '2024-01-01',
            'pdf' => 'laporan_a.pdf',
            'word' => 'laporan_a.docx',
        ],
        [
            'judul' => 'Laporan Proyek B',
            'penulis' => 'Jane Smith',
            'tanggal' => '2024-01-15',
            'pdf' => 'laporan_b.pdf',
            'word' => 'laporan_b.docx',
        ],
    ];
}

// Tambahkan laporan baru
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $judul = htmlspecialchars($_POST['judul']);
    $isi = htmlspecialchars($_POST['isi']);
    $tanggal = date('Y-m-d');

    // Simpan laporan baru ke dalam array
    $_SESSION['laporan'][] = [
        'judul' => $judul,
        'penulis' => 'Admin', // Bisa disesuaikan
        'tanggal' => $tanggal,
        'pdf' => '', // Untuk saat ini tidak menghasilkan file
        'word' => '',
    ];
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Laporan Proyek</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid #ccc;
            padding: 10px;
            text-align: left;
        }
        th {
            background-color: #f4f4f4;
        }
        a {
            text-decoration: none;
            color: #007BFF;
        }
        a:hover {
            text-decoration: underline;
        }
        form {
            margin-top: 20px;
        }
        form div {
            margin-bottom: 10px;
        }
        label {
            display: block;
            font-weight: bold;
        }
        input, textarea, button {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
        }
        button {
            background-color: #007BFF;
            color: #fff;
            border: none;
            cursor: pointer;
        }
        button:hover {
            background-color: #0056b3;
        }
    </style>

</head>
<body>
        {{-- Memasukkan bagian navigasi utama --}}
        {{-- @include('navigasiutama') --}}

    <h1>Halaman Laporan Proyek</h1>

    <!-- Form untuk membuat laporan baru -->
    <h2>Buat Laporan Baru</h2>
    <form method="POST" action="">
        <div>
            <label for="judul">Judul Laporan</label>
            <input type="text" id="judul" name="judul" required>
        </div>
        <div>
            <label for="isi">Isi Laporan</label>
            <textarea id="isi" name="isi" rows="5" required></textarea>
        </div>
        <button type="submit">Tambah Laporan</button>
    </form>

    <!-- Daftar laporan -->
    <h2>Daftar Laporan</h2>
    <table>
        <thead>
            <tr>
                <th>Judul Laporan</th>
                <th>Nama Penulis</th>
                <th>Tanggal</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($_SESSION['laporan'] as $data): ?>
                <tr>
                    <td><?php echo htmlspecialchars($data['judul']); ?></td>
                    <td><?php echo htmlspecialchars($data['penulis']); ?></td>
                    <td><?php echo htmlspecialchars($data['tanggal']); ?></td>
                    <td>
                        <?php if ($data['pdf']): ?>
                            <a href="downloads/<?php echo htmlspecialchars($data['pdf']); ?>" target="_blank">Unduh PDF</a> |
                        <?php endif; ?>
                        <?php if ($data['word']): ?>
                            <a href="downloads/<?php echo htmlspecialchars($data['word']); ?>" target="_blank">Unduh Word</a>
                        <?php endif; ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>
