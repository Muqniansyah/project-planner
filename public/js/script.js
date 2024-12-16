// Fungsi untuk membuka modal pertama dan menampilkan data
function openModal(title, description, anggaran) {
    document.getElementById("modalTitle").innerText = title;
    document.getElementById("modalDescription").innerText = description;
    document.getElementById("modalAnggaran").innerText =
        "Anggaran: " + anggaran;

    // Menampilkan modal pertama
    document.getElementById("projectModal").classList.remove("hidden");
}

// Fungsi untuk membuka modal kedua (form edit)
function openEditModal() {
    // Menampilkan modal edit
    document.getElementById("editModal").classList.remove("hidden");

    // Menutup modal pertama
    closeModal("projectModal");
}

// Fungsi untuk menutup modal berdasarkan id
function closeModal(modalId) {
    document.getElementById(modalId).classList.add("hidden");
}

// Simulasi tombol edit di modal pertama (dapat diganti dengan event listener)
document
    .getElementById("editButton")
    .addEventListener("click", function (event) {
        event.preventDefault();

        // Data yang akan ditampilkan di modal
        openModal(
            "Judul Proyek",
            "Deskripsi proyek yang lebih panjang...",
            "Rp 1.000.000"
        );
    });
