<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Proyek Detail</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f9f9f9;
        }

        h1 {
            text-align: center;
            margin: 20px 0;
        }

        .contain {
            max-width: 1200px;
            margin: auto;
            padding: 20px;
            background: #fff;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }

        .chart-container {
            position: relative;
            width: 100%;
            max-width: 100%;
            margin: auto;
        }

        canvas {
            display: block;
            max-width: 100%;
            height: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        table th, table td {
            text-align: center;
            padding: 10px;
            border: 1px solid #ddd;
        }

        table th {
            background-color: #f4f4f4;
        }

        table tbody tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        @media (max-width: 768px) {
            h1 {
                font-size: 1.5rem;
            }

            table {
                font-size: 0.9rem;
            }

            table th, table td {
                padding: 8px;
            }
        }

        @media (max-width: 480px) {
            table {
                font-size: 0.8rem;
            }
        }
    </style>
</head>
<body>
    <div class="contain">
        <h1>Progres Proyek: {{ $project->name }}</h1>

        <!-- Grafik Progres -->
        <div class="chart-container">
            <canvas id="progressChart"></canvas>
        </div>

        <!-- Tabel Progres Mingguan -->
        <table>
            <thead>
                <tr>
                    <th>Minggu</th>
                    <th>Progres Kumulatif (%)</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($cumulativeProgressPercentage as $week => $progress)
                    <tr>
                        <td>{{ $week + 1 }}</td>
                        <td>{{ number_format($progress, 2) }}%</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <script>
        // Data dari server (Blade Laravel)
        const cumulativeProgress = [0, ...@json($cumulativeProgressPercentage)];

        // Labels (Minggu ke-0, ke-1, ke-2, dst.)
        const labels = cumulativeProgress.map((_, index) => `Minggu ${index}`);

        // Konfigurasi Chart.js
        const ctx = document.getElementById('progressChart').getContext('2d');
        new Chart(ctx, {
            type: 'line',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Progres Kumulatif (%)',
                    data: cumulativeProgress,
                    borderColor: 'rgba(75, 192, 192, 1)',
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    borderWidth: 2,
                    fill: true,
                    tension: 0.3
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        display: true,
                        position: 'top'
                    },
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                return `${context.raw.toFixed(2)}%`;
                            }
                        }
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        max: 100,
                        title: {
                            display: true,
                            text: 'Progres (%)'
                        }
                    },
                    x: {
                        title: {
                            display: true,
                            text: 'Minggu'
                        }
                    }
                }
            }
        });
    </script>
</body>
</html>
