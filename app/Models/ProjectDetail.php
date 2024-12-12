<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectDetail extends Model
{
    use HasFactory;

    protected $appends = ["open"];

    public function getOpenAttribute()
    {
        return true;
    }

    protected $table = 'project_details';
    protected $fillable = ['text', 'duration', 'start_date', 'end_date', 'progress', 'parent', 'project_id'];
}
