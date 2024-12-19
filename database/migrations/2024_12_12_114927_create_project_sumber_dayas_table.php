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
        Schema::create('project_sumber_dayas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('project_id');
            $table->unsignedBigInteger('sumber_daya_id');   
            $table->integer('quantity');
            $table->foreign('project_id')->references('id')->on('projects')->onDelete('cascade');
            $table->foreign('sumber_daya_id')->references('id')->on('sumber_dayas')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('project_sumber_dayas');
    }
};
