import "./bootstrap";
import Alpine from "alpinejs";

window.Alpine = Alpine;
Alpine.start();

document.addEventListener("DOMContentLoaded", () => {
    // Ambil semua tombol dropdown
    const dropdownButtons = document.querySelectorAll("[data-dropdown-button]");

    dropdownButtons.forEach((button) => {
        button.addEventListener("click", () => {
            const menu = button.nextElementSibling; // Ambil elemen menu dropdown
            if (menu) {
                menu.classList.toggle("hidden"); // Tampilkan atau sembunyikan menu
            }
        });
    });

    // Opsional: Tutup dropdown jika klik di luar
    document.addEventListener("click", (e) => {
        dropdownButtons.forEach((button) => {
            const menu = button.nextElementSibling;
            if (
                menu &&
                !menu.contains(e.target) &&
                !button.contains(e.target)
            ) {
                menu.classList.add("hidden");
            }
        });
    });
});
