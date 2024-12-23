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
        Schema::create('projects', function (Blueprint $table) {
            $table->id(); // Primary key
            $table->string('name', 255); // Nama proyek
            $table->text('description')->nullable(); // Deskripsi proyek
            $table->decimal('anggaran', 15, 2); // Anggaran proyek
            $table->string('status')->default('Pending'); // Status default "Pending"
            $table->dateTime('start_date');
            $table->dateTime('end_date')->nullable();
            $table->unsignedBigInteger('manager');
            $table->timestamps(); // created_at dan updated_at

            $table->foreign('manager')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
};
