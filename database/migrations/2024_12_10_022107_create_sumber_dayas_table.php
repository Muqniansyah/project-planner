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
        Schema::create('sumber_dayas', function (Blueprint $table) {
            $table->id(); // Primary key
            $table->unsignedBigInteger('project_id')->nullable(); // Foreign key ke tabel projects
            $table->string('name', 255); // Nama sumber daya
            $table->string('type', 255); // Jenis sumber daya
            $table->integer('quantity'); // Kuantitas sumber daya
            $table->string('status')->default('available'); // Status default "available"
            $table->timestamps(); // created_at dan updated_at

            // Menambahkan foreign key ke kolom project_id
            $table->foreign('project_id')->references('id')->on('projects')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sumber_dayas');
    }
};
