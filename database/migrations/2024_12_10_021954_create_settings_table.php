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
        Schema::create('settings', function (Blueprint $table) {
            $table->id(); // Primary key
            $table->unsignedBigInteger('user_id'); // Foreign key ke tabel users
            $table->string('notification', 255); // Nama notifikasi
            $table->text('message'); // Pesan notifikasi
            $table->enum('notification_value', ['harian', 'mingguan', 'bulanan']); // Pilihan notifikasi
            $table->date('expire_date'); // Tanggal kadaluarsa
            $table->timestamps(); // created_at dan updated_at

            // Menambahkan foreign key ke kolom user_id
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('settings');
    }
};
