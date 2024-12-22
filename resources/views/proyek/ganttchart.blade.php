<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gantt Chart</title>
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
            height: 70vh; /* Adjust height based on viewport height */
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

        /* Optional: Adjust Gantt chart width for small screens */
        @media (max-width: 767px) {
            #gantt_here {
                height: 60vh; /* Less height on small screens */
            }
        }

        /* Ensure horizontal scrolling for the task names */
        .gantt_task_cell {
            overflow-x: auto;
        }

        .gantt_task_row {
            overflow-y: auto;
        }
    </style>
</head>

<body>
    <div id="gantt_container" class="w-full overflow-auto contain">
        <div id="gantt_here"></div>
    </div>

    <script src="https://cdn.dhtmlx.com/gantt/edge/dhtmlxgantt.js"></script>
    <script type="text/javascript">
        // Konfigurasi dasar Gantt Chart
        gantt.config.date_format = "%Y-%m-%d %H:%i:%s";

        gantt.init("gantt_here");

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

        // Penyesuaian ukuran Gantt Chart ketika jendela diubah
        window.addEventListener("resize", function () {
            gantt.render();
        });

        // Tambahkan style untuk horizontal scrolling
        gantt.attachEvent("onRender", function () {
            const ganttContainer = document.getElementById("gantt_here");
            ganttContainer.style.overflowX = "auto";
            ganttContainer.style.overflowY = "auto";  // Add vertical scroll to the Gantt chart container
        });

        // Mengatur skala waktu responsif berdasarkan lebar layar
        const setScaleConfig = () => {
            const width = window.innerWidth;

            if (width < 768) {
                // Untuk layar kecil, gunakan skala waktu yang lebih besar
                gantt.config.scale_unit = "day";
                gantt.config.date_scale = "%d %M";
                gantt.config.subscales = [];
            } else if (width < 1024) {
                // Untuk layar sedang, gunakan skala mingguan
                gantt.config.scale_unit = "week";
                gantt.config.date_scale = "Week #%W";
                gantt.config.subscales = [{ unit: "day", step: 1, date: "%D" }];
            } else {
                // Untuk layar besar, gunakan skala bulanan
                gantt.config.scale_unit = "month";
                gantt.config.date_scale = "%F, %Y";
                gantt.config.subscales = [{ unit: "day", step: 1, date: "%d" }];
            }
        };

        // Terapkan konfigurasi skala waktu saat aplikasi dimuat dan ukuran layar berubah
        setScaleConfig();
        window.addEventListener("resize", () => {
            setScaleConfig();
            gantt.render();
        });
    </script>
</body>

</html>
