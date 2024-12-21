<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProjectSumberDaya extends Model
{
    // Nama tabel jika tidak mengikuti konvensi Laravel
    protected $table = 'project_sumber_dayas';

    // Kolom yang dapat diisi secara massal
    protected $fillable = ['project_id', 'sumber_daya_id', 'quantity', 'jenis'];

    // Definisikan relasi dengan Project
    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    // Definisikan relasi dengan SumberDaya
    public function sumberDaya()
    {
        return $this->belongsTo(SumberDaya::class, 'sumber_daya_id');
    }

}
