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
            $table->id(); // Primary key
            $table->unsignedBigInteger('project_id'); // Foreign key to 'project' table
            $table->string('title', 255); // Title of the report
            $table->unsignedBigInteger('generated_by')->nullable(); // Foreign key to 'user' table
            $table->string('file_path', 255)->nullable(); // Path to the report file
            $table->timestamps(); // created_at and updated_at columns

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
