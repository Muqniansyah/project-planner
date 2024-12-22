<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description', 'anggaran', 'status', 'start_date', 'end_date'];

    /**
     * Relasi ke model ProjectDetail
     */
    public function details()
    {
        return $this->hasMany(ProjectDetail::class);
    }

    /**
     * Relasi ke model Laporan
     */
    public function laporan()
    {
        return $this->hasMany(Laporan::class);
    }

    /**
     * Relasi ke model User (dibuat oleh)
     */
    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    // pengguna yang terlibat dalam proyek(notifikasi)
    public function user()
{
    return $this->belongsTo(User::class);
}
}
