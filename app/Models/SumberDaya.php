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
        return $this->belongsTo(Project::class, 'project_id')->nullable();
    }

    public function projectSumberDaya()
    {
        return $this->hasMany(ProjectSumberDaya::class);
    }

    public function users()
    {
        return $this->hasMany(User::class, 'jobdesk');
    }
}