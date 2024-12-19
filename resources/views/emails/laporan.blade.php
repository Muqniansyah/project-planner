<!DOCTYPE html>
<html>
<head>
    <title>Laporan Proyek</title>
</head>
<body>
    <h1>{{ $laporan->title }}</h1>
    <p><strong>Nama Pembuat:</strong> {{ $laporan->author }}</p>
    <p><strong>Tanggal:</strong> {{ $laporan->report_date }}</p>
    <p><strong>Isi Laporan:</strong></p>
    <p>{{ $laporan->description }}</p>
    <br>
    <p>Terima kasih,</p>
    <p>Tim Laporan Proyek</p>
</body>
</html>
