<?php

namespace App\Models;

use App\Traits\UUID;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CourseStages extends Model
{
    use HasFactory,SoftDeletes;
    protected $guarded = [];
    public function courses()
    {
        return $this->belongsToMany(Courses::class,'course_stages')->distinct();
    }
    public function lessons()
    {
        return $this->belongsToMany(Lessons::class, 'course_stages', 'stage_id', 'lesson_id')->distinct();
    }
}


