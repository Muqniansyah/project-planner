<!-- Grafik Progres -->
    <div style="width: 80%; margin: auto;">
        <canvas id="progressChart"></canvas>
    </div>

    <!-- Tabel Progres Mingguan -->
    <table border="1" style="width: 80%; margin: auto; text-align: center; margin-top: 20px;">
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