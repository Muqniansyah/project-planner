// Fungsi untuk membuka modal pertama dan menampilkan data
function openModal(id, title, description, anggaran) {
    document.getElementById("modalTitle").innerText = title;
    document.getElementById("modalDescription").innerText = description;
    document.getElementById("modalAnggaran").innerText =
        "Anggaran: " + anggaran;

    // Perbarui href tombol Edit
    const editButton = document.getElementById("editButton");
    editButton.href = `/proyek/edit/${id}`;

    // Menampilkan modal
    document.getElementById("projectModal").classList.remove("hidden");
}

// Fungsi untuk menutup modal berdasarkan id
function closeModal(modalId) {
    document.getElementById(modalId).classList.add("hidden");
}
