<?php

namespace App\Models;

use App\Traits\UUID;
use App\Models\Category;
use App\Models\CourseTrainers;
use App\Models\CourseEnrolleds;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Courses extends Model
{
    use UUID, HasFactory, SoftDeletes;
    protected $guarded = [];
    public function coursetrainers()
    {
        return $this->hasMany(CourseTrainers::class, 'course_id');
    }

    public function courseenrolled()
    {
        return $this->hasMany(CourseEnrolleds::class, 'course_id');
    }
    public function isEnrolledInCourse($courseId)
    {
        $userId = Auth::guard('student')->id();
        return CourseEnrolleds::where('user_id', $userId)
                              ->where('course_id', $courseId)
                              ->exists();
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function stages()
    {

        return $this->belongsToMany(Stages::class,'course_stages','course_id', 'stage_id');
    }
    public function lessons()
    {

        return $this->belongsTo(Lessons::class);
    }
    public function getImageurlAttribute()
    {
        return path($this->id,'courses') . '/' .'images'.'/' . $this->image;
    }

    public function comments()
    {
        return $this->morphMany(Comments::class, 'commentable');
    }
}
