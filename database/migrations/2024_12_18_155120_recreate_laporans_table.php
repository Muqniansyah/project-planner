<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Hapus tabel 'laporans' jika sudah ada
        Schema::dropIfExists('laporans');

        // Buat ulang tabel 'laporans'
        Schema::create('laporans', function (Blueprint $table) {
            $table->id();                        // Primary key
            $table->string('author');            // Nama pembuat laporan
            $table->date('report_date');         // Tanggal laporan
            $table->string('title');             // Judul laporan
            $table->text('description');         // Deskripsi laporan
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Hapus tabel 'laporans' jika migration di-rollback
        Schema::dropIfExists('laporans');
    }
};
