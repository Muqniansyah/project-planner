function addProject() {
    const title = document.getElementById("title").value;
    const description = document.getElementById("description").value;
    const budget = document.getElementById("budget").value;
    const resource = document.getElementById("resource").value;
    const startDate = document.getElementById("start-date").value;
    const endDate = document.getElementById("end-date").value;
    const status = document.getElementById("status").value;
    const createdBy = document.getElementById("created-by").value;

    if (
        title &&
        description &&
        budget &&
        resource &&
        startDate &&
        endDate &&
        status &&
        createdBy
    ) {
        const projectList = document.getElementById("project-list");
        const projectItem = document.createElement("div");
        projectItem.classList.add("project-item");
        projectItem.innerHTML = `
            <h3>${title}</h3>
            <p>${description}</p>
            <p><strong>Anggaran:</strong> ${budget}</p>
            <p><strong>Sumber Daya:</strong> ${resource}</p>
            <p><strong>Tanggal Mulai:</strong> ${startDate}</p>
            <p><strong>Tanggal Selesai:</strong> ${endDate}</p>
            <p><strong>Status:</strong> ${status}</p>
            <p><strong>Dibuat Oleh:</strong> ${createdBy}</p>
            <button onclick="toggleDetails(this)">Tutup Detail Proyek</button>
        `;
        projectList.appendChild(projectItem);
        clearForm();
    } else {
        alert("Silakan lengkapi semua field!");
    }
}

function clearForm() {
    document.getElementById("project-form").reset();
}

function toggleDetails(button) {
    const projectItem = button.parentElement;
    projectItem.classList.toggle("collapsed");
    button.textContent = projectItem.classList.contains("collapsed")
        ? "Tampilkan Detail Proyek"
        : "Tutup Detail Proyek";
}
