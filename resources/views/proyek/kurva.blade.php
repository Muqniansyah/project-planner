 <canvas id="progressWeeklyChart" width="800" height="400"></canvas>

<script>
    // Data dari controller
    const cumulativeProgress = @json($cumulativeProgress);
    const totalWeeks = {{ $totalWeeks }};
    const projectStartDate = new Date({{ $projectStartDate * 1000 }}); // UNIX timestamp

    // Generate label minggu
    const labels = Array.from({
        length: totalWeeks
    }, (_, index) => {
        const startOfWeek = new Date(projectStartDate.getTime() + index * 7 * 86400 * 1000);
        const endOfWeek = new Date(startOfWeek.getTime() + 6 * 86400 * 1000);
        return `${startOfWeek.getDate()}-${startOfWeek.getMonth() + 1} s/d ${endOfWeek.getDate()}-${endOfWeek.getMonth() + 1}`;
    });

    // Konfigurasi Chart.js
    const ctx = document.getElementById('progressWeeklyChart').getContext('2d');
    new Chart(ctx, {
        type: 'line',
        data: {
            labels: labels,
            datasets: [{
                label: 'Persentase Penyelesaian (%)',
                data: cumulativeProgress,
                borderColor: 'blue',
                backgroundColor: 'rgba(0, 0, 255, 0.2)',
                fill: true,
                pointRadius: 3,
                tension: 0.3,
            }],
        },
        options: {
            responsive: true,
            plugins: {
                title: {
                    display: true,
                    text: 'Progress Timeline - Per Minggu',
                },
            },
            scales: {
                y: {
                    beginAtZero: true,
                    max: 100,
                    title: {
                        display: true,
                        text: 'Persentase Penyelesaian (%)',
                    },
                },
                x: {
                    title: {
                        display: true,
                        text: 'Minggu',
                    },
                },
            },
        },
    });
</script>
