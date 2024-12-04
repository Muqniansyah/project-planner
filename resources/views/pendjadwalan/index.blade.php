<!DOCTYPE html>
<html lang="en">
        {{-- Memasukkan bagian navigasi utama --}}
        {{-- @include('navigasiutama') --}}
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Modul Penjadwalan</title>
    <style>
      body {
        font-family: Arial, sans-serif;
        background-color: #f9f9f9;
        padding: 20px;
        line-height: 1.6;
      }

      h1,
      h2 {
        color: #34495e;
      }

      .scheduling-module {
        max-width: 900px;
        margin: auto;
        background: #ffffff;
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
      }

      section {
        margin-bottom: 30px;
      }

      form label {
        display: block;
        margin: 10px 0 5px;
      }

      form input,
      form button {
        width: 100%;
        padding: 10px;
        margin-bottom: 15px;
        border: 1px solid #ccc;
        border-radius: 5px;
      }

      form button {
        background-color: #3498db;
        color: #fff;
        cursor: pointer;
      }

      form button:hover {
        background-color: #2980b9;
      }

      #gantt-container,
      #sCurveChart {
        margin: 20px 0;
      }

      #task-list {
        list-style: none;
        padding: 0;
      }

      #task-list li {
        margin-bottom: 10px;
        padding: 10px;
        background-color: #f1f1f1;
        border-radius: 5px;
      }
    </style>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <!-- Untuk Kurva S -->
  </head>

  <body>
    <h2 style="text-align: center">Modul Penjadwalan</h2>
    <div class="scheduling-module">

      <!-- Pembuatan Jadwal dengan Diagram Gantt -->
      <section class="gantt-chart">
        <h2>Diagram Gantt</h2>
        <div id="gantt-container">
          <!-- Diagram Gantt akan ditampilkan di sini -->
          <canvas id="ganttCanvas" width="800" height="400"></canvas>
        </div>
        <button id="generate-gantt">Buat Diagram Gantt</button>
      </section>

      <!-- Penetapan Deadline -->
      <section class="task-deadlines">
        <h2>Penetapan Deadline</h2>
        <form id="task-form">
          <label for="task-name">Nama Tugas:</label>
          <input type="text" id="task-name" required />

          <label for="task-deadline">Deadline:</label>
          <input type="date" id="task-deadline" required />

          <button type="submit">Tambah Tugas</button>
        </form>
        <ul id="task-list">
          <!-- Daftar tugas dengan deadline -->
        </ul>
      </section>

      <!-- Pembuatan Diagram Kurva S -->
      <section class="s-curve">
        <h2>Diagram Kurva S</h2>
        <canvas id="sCurveChart"></canvas>
      </section>

      <!-- Notifikasi -->
      <section class="notifications">
        <h2>Notifikasi</h2>
        <p id="notification-message">Tidak ada notifikasi saat ini.</p>
      </section>
    </div>

    <script>
      document.addEventListener("DOMContentLoaded", () => {
        // 1. Diagram Gantt
        const ganttCanvas = document.getElementById("ganttCanvas");
        const ganttCtx = ganttCanvas.getContext("2d");

        document
          .getElementById("generate-gantt")
          .addEventListener("click", () => {
            ganttCtx.clearRect(0, 0, ganttCanvas.width, ganttCanvas.height);

            const tasks = ["Desain", "Pengadaan", "Konstruksi"];
            const durations = [3, 5, 7];
            const colors = ["#3498db", "#2ecc71", "#e74c3c"];
            let xStart = 0;

            tasks.forEach((task, i) => {
              ganttCtx.fillStyle = colors[i];
              ganttCtx.fillRect(xStart, 50, durations[i] * 50, 40); // Scale: 1 hari = 50px
              ganttCtx.fillStyle = "#000";
              ganttCtx.fillText(task, xStart + 5, 45);
              xStart += durations[i] * 50;
            });
          });

        // 2. Penetapan Deadline
        const taskForm = document.getElementById("task-form");
        const taskList = document.getElementById("task-list");

        taskForm.addEventListener("submit", (e) => {
          e.preventDefault();
          const taskName = document.getElementById("task-name").value;
          const taskDeadline = document.getElementById("task-deadline").value;

          const li = document.createElement("li");
          li.textContent = `${taskName} - Deadline: ${taskDeadline}`;
          taskList.appendChild(li);

          taskForm.reset();
          checkDeadlines();
        });

        // 3. Diagram Kurva S
        const ctx = document.getElementById("sCurveChart").getContext("2d");
        const sCurveChart = new Chart(ctx, {
          type: "line",
          data: {
            labels: ["Minggu 1", "Minggu 2", "Minggu 3", "Minggu 4"],
            datasets: [
              {
                label: "Progress Aktual",
                data: [10, 30, 50, 80],
                borderColor: "#3498db",
                fill: false,
              },
              {
                label: "Progress Direncanakan",
                data: [20, 40, 60, 100],
                borderColor: "#e74c3c",
                fill: false,
              },
            ],
          },
        });

        // 4. Notifikasi Tenggat Waktu
        function checkDeadlines() {
          const today = new Date();
          let notification = "Tidak ada notifikasi saat ini.";

          document.querySelectorAll("#task-list li").forEach((li) => {
            const deadline = new Date(li.textContent.split("Deadline: ")[1]);
            if (deadline < today) {
              notification = `Tugas "${
                li.textContent.split(" - ")[0]
              }" melewati tenggat waktu!`;
            }
          });

          document.getElementById("notification-message").textContent =
            notification;
        }
      });
    </script>
  </body>
</html>
