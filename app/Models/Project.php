<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description', 'anggaran', 'status', 'start_date', 'end_date', 'manager'];

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

    public function manager()
    {
        return $this->belongsTo(User::class, 'manager');
    }

    public function sumberDaya()
    {
        return $this->hasMany(ProjectSumberDaya::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'project_user');
    }
}
