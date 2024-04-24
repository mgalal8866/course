<?php

namespace App\Models;

use App\Traits\UUID;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CourseStages extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function courses()
    {
        return $this->belongsToMany(Courses::class,'course_stages')->distinct();
    }
    public function lessons()
    {
        return $this->belongsTo(Lessons::class, 'lesson_id');
    }
    public function stage()
    {
        return $this->belongsTo(Stages::class, 'stage_id');
    }
}


