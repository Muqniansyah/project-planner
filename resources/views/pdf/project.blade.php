<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Detail Proyek</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            box-sizing: border-box;
        }
        h1 {
            text-align: center;
            margin-bottom: 20px; /* Menyesuaikan margin jika diperlukan */
            padding-bottom: 10px; /* Padding di bawah untuk garis */
            border-bottom: 3px solid black; /* Garis bawah tebal */
        }
        .project-details {
            text-align: left;
            line-height: 1.6;
            width: 100%;
        }
        .detail-item {
            margin-bottom: 10px; /* Menyesuaikan margin antar baris */
        }
    </style>
</head>
<body>
    <h1>Laporan Detail Proyek</h1>
    <div class="project-details">
        <div class="detail-item"><strong>Nama Proyek:</strong> {{ $project->name }}</div>
        <div class="detail-item"><strong>Deskripsi:</strong> {{ $project->description }}</div>
        <div class="detail-item"><strong>Anggaran:</strong> ${{ number_format($project->anggaran, 2) }}</div>
        <div class="detail-item"><strong>Start Date:</strong> {{ $project->start_date }}</div>
        <div class="detail-item"><strong>End Date:</strong> {{ $project->end_date }}</div>
        <div class="detail-item"><strong>Status:</strong> {{ $project->status }}</div>
    </div>
</body>
</html>
