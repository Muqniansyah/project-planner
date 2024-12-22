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
            $table->string('name', 255); // Nama sumber daya
            $table->string('type', 255); // Jenis sumber daya
            $table->integer('quantity'); // Kuantitas sumber daya
            $table->enum('status', ['Available', 'Not Available'])->default('Available'); // Status dengan default "Available"
            $table->timestamps(); // created_at dan updated_at
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
