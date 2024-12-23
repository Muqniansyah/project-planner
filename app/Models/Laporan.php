<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Laporan extends Model
{
    use HasFactory;

    protected $table = 'laporans'; // Nama tabel

    protected $fillable = ['author', 'report_date', 'title' , 'description','project_id'];
    // protected $fillable = ['author', 'title' , 'contect','date',];

    /**
     * Relasi ke model Project
     */
    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    /**
     * Relasi ke model User (dibuat oleh)
     */
    public function generator()
    {
        return $this->belongsTo(User::class, 'generated_by');
    }

    /**
     * Relasi tambahan untuk keperluan spesifik(laporan)
     */
    public function relatedProject()
    {
        return $this->belongsTo(Project::class, 'project_id');
    }
}

