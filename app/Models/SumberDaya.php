<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SumberDaya extends Model
{
    use HasFactory;

    protected $fillable = ['project_id', 'name', 'type', 'quantity', 'status'];

    /**
     * Relasi ke model Project
     */
    public function project()
    {
        return $this->belongsToMany(Project::class, 'project_sumber_dayas')
                                ->withPivot('quantity');
    }

    public function users()
    {
        return $this->hasMany(User::class, 'jobdesk');
    }
}