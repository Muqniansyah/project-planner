<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Laporan PDF</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        h1 {
            text-align: center;
        }
        .table {
            width: 100%;
            border-collapse: collapse;
        }
        .table th, .table td {
            border: 1px solid #ddd;
            padding: 8px;
        }
        .table th {
            background-color: #f2f2f2;
            text-align: left;
        }
    </style>
</head>
<body>
    <h1>{{ $laporan->title }}</h1>
    <p><strong>Nama Pembuat:</strong> {{ $laporan->author }}</p>
    <p><strong>Tanggal:</strong> {{ $laporan->report_date }}</p>
    <p><strong>Isi Laporan:</strong></p>
    <p>{{ $laporan->description }}</p>
</body>
</html>
