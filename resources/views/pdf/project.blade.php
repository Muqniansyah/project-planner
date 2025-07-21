<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Detail Proyek</title>
        <link rel="stylesheet" href="https://cdn.dhtmlx.com/gantt/edge/dhtmlxgantt.css" type="text/css">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        html,
        body {
            height: 100%;
            margin: 0;
            padding: 0;
        }

        #gantt_container {
            width: 100%;
            height: 100%;
            display: flex;
            justify-content: center;
            padding: 20px;
            overflow: hidden;
        }

        #gantt_here {
            width: 100%;
            min-width: 600px;
            height: 70vh;
            overflow: hidden;
        }

        .contain {
            width: 100%;
            max-width: 1200px;
            margin: auto;
            padding: 20px;
            background: #fff;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            overflow: hidden;
        }

        @media (max-width: 767px) {
            #gantt_here {
                height: 60vh;
            }
        }

        .gantt_task_cell {
            overflow-x: auto;
        }

        .gantt_task_row {
            overflow-y: auto;
        }
    </style>
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

        <div id="gantt_container" class="w-full overflow-auto contain">
        <div id="gantt_here"></div>
    </div>

    <script src="https://cdn.dhtmlx.com/gantt/edge/dhtmlxgantt.js"></script>
    <script type="text/javascript">
        // Konfigurasi dasar Gantt Chart
        gantt.config.date_format = "%Y-%m-%d %H:%i:%s";

        gantt.init("gantt_here");

        // Memuat data gantt
        gantt.load("/api/data/{{ $project->id }}");

        var dp = new gantt.dataProcessor("/api");
        dp.init(gantt);
        dp.setTransactionMode("REST", true);

        console.log("Gantt data load URL:", "/api/data/{{ $project->id }}");

        dp.attachEvent("onBeforeUpdate", function(id, task, action) {
            action.project_id = {{ $project->id }};
            console.log(action);
            return action;
        });

        // Tanggal awal dan akhir proyek
        const projectStartDate = new Date("{{ $project->start_date }}"); // Contoh: "2024-01-01"
        const projectEndDate = new Date("{{ $project->end_date }}"); // Contoh: "2024-12-31"

        // Atur tampilan awal Gantt Chart dimulai dari tanggal proyek
        gantt.config.start_date = projectStartDate;
        gantt.config.end_date = projectEndDate;

        // Set default value untuk tanggal task saat form dibuka
        gantt.attachEvent("onLightbox", function(task_id) {
            const task = gantt.getTask(task_id);
            if (!task.start_date) {
                task.start_date = new Date(projectStartDate); // Set default start_date
                task.end_date = new Date(task.start_date.getTime() + 24 * 60 * 60 * 1000); // Tambah 1 hari
            }
            gantt.updateTask(task_id);
        });

        // Penyesuaian ukuran Gantt Chart ketika jendela diubah
        window.addEventListener("resize", function() {
            gantt.render();
        });

        // Mengatur skala waktu responsif berdasarkan lebar layar
        const setScaleConfig = () => {
            const width = window.innerWidth;

            if (width < 768) {
                gantt.config.scale_unit = "day";
                gantt.config.date_scale = "%d %M";
                gantt.config.subscales = [];
            } else if (width < 1024) {
                gantt.config.scale_unit = "week";
                gantt.config.date_scale = "Week #%W";
                gantt.config.subscales = [{
                    unit: "day",
                    step: 1,
                    date: "%D"
                }];
            } else {
                gantt.config.scale_unit = "month";
                gantt.config.date_scale = "%F, %Y";
                gantt.config.subscales = [{
                    unit: "day",
                    step: 1,
                    date: "%d"
                }];
            }
        };

        setScaleConfig();
        window.addEventListener("resize", () => {
            setScaleConfig();
            gantt.render();
        });

        // Cek role user dan hanya biarkan user dengan role 'manager' yang bisa menambah task
        const userRole = "{{ Auth::user()->role }}";  // Pastikan 'role' tersedia dalam data pengguna

        if (userRole !== 'manager') {
            gantt.config.readonly = true; // Membuat chart hanya bisa dibaca jika bukan manager
        }

        // Fungsi untuk mencegah penambahan task jika bukan manager
        gantt.attachEvent("onBeforeTaskAdd", function(task) {
            if (userRole !== 'manager') {
                alert("Anda tidak memiliki hak untuk menambah task.");
                return false; // Mencegah penambahan task
            }
            return true; // Memungkinkan penambahan task jika manager
        });

    </script>
</body>
</html>
