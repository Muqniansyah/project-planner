<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Laporan extends Model
{
    use HasFactory;

    protected $fillable = ['project_id', 'title', 'generated_by', 'file_path'];

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
}
