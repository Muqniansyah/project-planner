<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            // Menambahkan kolom job_desk_id yang nullable
            $table->unsignedBigInteger('jobdesk')->nullable();

            // Menambahkan foreign key dengan nama job_desk
            $table->foreign('jobdesk', 'job_desk')  // Nama foreign key
                ->references('id')                    // Kolom yang direferensikan di tabel job_desk
                ->on('sumber_dayas')                       // Nama tabel job_desk
                ->onDelete('set null');                // Jika data di job_desk dihapus, set nilai job_desk_id menjadi null
        });
    }

    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            // Menghapus foreign key dan kolom job_desk_id
            $table->dropForeign('job_desk');  // Menghapus foreign key dengan nama job_desk
            $table->dropColumn('jobdesk');
        });
    }
};
