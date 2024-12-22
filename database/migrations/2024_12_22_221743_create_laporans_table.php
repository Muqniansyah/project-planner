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
        Schema::create('laporans', function (Blueprint $table) {
            $table->id();
            $table->string('author'); // Nama pembuat laporan
            $table->date('report_date'); // Tanggal laporan
            $table->string('title'); // Judul laporan
            $table->text('description'); // Deskripsi laporan
            $table->unsignedBigInteger('project_id')->nullable(); // Foreign key ke 'projects'
            $table->unsignedBigInteger('generated_by')->nullable(); // Foreign key ke 'users'
            $table->string('file_path', 255)->nullable(); // Path file laporan
            $table->timestamps(); // Kolom created_at dan updated_at

            // Foreign key constraints
            $table->foreign('project_id')->references('id')->on('projects')->onDelete('cascade');
            $table->foreign('generated_by')->references('id')->on('users')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('laporans');
    }
};
