// Fungsi untuk membuka modal
function openModal(title, description, anggaran) {
    document.getElementById("modalTitle").innerText = title;
    document.getElementById(
        "modalDescription"
    ).innerText = `Deskripsi: ${description}`;
    document.getElementById(
        "modalAnggaran"
    ).innerText = `Anggaran: $${anggaran}`;
    document.getElementById("projectModal").classList.remove("hidden");
}

// Fungsi untuk menutup modal
function closeModal() {
    document.getElementById("projectModal").classList.add("hidden");
}
