<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SumberDaya extends Model
{
    use HasFactory;

    protected $fillable = ['project_id', 'type', 'name', 'quantity'];

    /**
     * Relasi ke model Project
     */
    public function project()
    {
        return $this->belongsTo(Project::class, 'project_id');
    }
}
