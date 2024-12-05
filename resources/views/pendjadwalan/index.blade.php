<x-app-layout>
    <x-slot name="title">
        Modul Penjadwalan
    </x-slot>

    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800 leading-tight">
            Penjadwalan Proyek
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Diagram Gantt -->
            <section class="bg-white shadow-md rounded-lg mb-6">
                <header class="bg-blue-600 text-white p-4 rounded-t-lg">
                    <h5 class="text-lg font-semibold text-center">Diagram Gantt</h5>
                </header>
                <div class="p-4 overflow-x-auto">
                    <canvas id="ganttCanvas" width="800" height="400"></canvas>
                    <button id="generate-gantt" class="mt-4 w-full px-4 py-2 text-white bg-blue-600 rounded hover:bg-blue-700">
                        Buat Diagram Gantt
                    </button>
                </div>
            </section>

            <!-- Penetapan Deadline -->
            <section class="bg-white shadow-md rounded-lg mb-6">
                <header class="bg-blue-600 text-white p-4 rounded-t-lg">
                    <h5 class="text-lg font-semibold text-center">Penetapan Deadline</h5>
                </header>
                <div class="p-4">
                    <form id="task-form">
                        <div class="mb-4">
                            <label for="task-name" class="block text-sm font-medium text-gray-700">Nama Tugas</label>
                            <input type="text" id="task-name" class="w-full p-2 border border-gray-300 rounded focus:ring-blue-500 focus:border-blue-500" required>
                        </div>
                        <div class="mb-4">
                            <label for="task-deadline" class="block text-sm font-medium text-gray-700">Deadline</label>
                            <input type="date" id="task-deadline" class="w-full p-2 border border-gray-300 rounded focus:ring-blue-500 focus:border-blue-500" required>
                        </div>
                        <button type="submit" class="w-full px-4 py-2 text-white bg-blue-600 rounded hover:bg-blue-700">
                            Tambah Tugas
                        </button>
                    </form>
                    <ul id="task-list" class="mt-4">
                        <!-- Daftar tugas dengan deadline -->
                    </ul>
                </div>
            </section>

            <!-- Diagram Kurva S -->
            <section class="bg-white shadow-md rounded-lg mb-6">
                <header class="bg-blue-600 text-white p-4 rounded-t-lg">
                    <h5 class="text-lg font-semibold text-center">Diagram Kurva S</h5>
                </header>
                <div class="p-4">
                    <canvas id="sCurveChart"></canvas>
                </div>
            </section>

            <!-- Notifikasi -->
            <section class="bg-white shadow-md rounded-lg">
                <header class="bg-blue-600 text-white p-4 rounded-t-lg">
                    <h5 class="text-lg font-semibold text-center">Notifikasi</h5>
                </header>
                <div class="p-4">
                    <p id="notification-message" class="text-center text-gray-700">Tidak ada notifikasi saat ini.</p>
                </div>
            </section>
        </div>
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
</x-app-layout>
