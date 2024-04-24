<?php

namespace App\Models;

use App\Traits\UUID;
use Illuminate\Database\Eloquent\Builder;
use App\Models\Category;
use App\Models\CourseStages;
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

        return $this->belongsToMany(Stages::class,'course_stages','course_id', 'stage_id' )->withPivot('publish_at')->withTimestamps();
    }
    public function stagesparent()
    {
         return $this->hasMany(CourseStages::class,'course_id'  );
    }

    public function lessons()
    {
        return $this->belongsToMany(Lessons::class, 'course_stages', 'course_id','lesson_id')->withPivot('publish_at')->withTimestamps();
    }
    public function getImageurlAttribute()
    {
        if($this->image ==null){

            return '';
        }
        return path($this->id,'courses') .'images'.'/' . $this->image;
    }
    public function getCalcRateurlAttribute()
    {
        if($this->calc_rate ==null){

            return '';
        }

        return path($this->id,'courses') .'images'.'/' . $this->calc_rate;
    }

    public function getScheduleurlAttribute()
    {
        if($this->schedule == null){

            return '';
        }
        return path($this->id,'courses') .'doc'.'/' . $this->schedule;
    }
    public function getFileFreeurlAttribute()
    {
        if($this->file_free ==null){

            return '';
        }
        return path($this->id,'courses') .'doc'.'/' . $this->file_free;
    }
    public function getFileSupplementaryurlAttribute()
    {
        if($this->file_supplementary ==null){

            return '';
        }
        return path($this->id,'courses') .'doc'.'/' . $this->file_supplementary;
    }
    public function getFileAggregatesurlAttribute()
    {
        if($this->file_aggregates ==null){

            return '';
        }
        return path($this->id,'courses') .'doc'.'/' . $this->file_aggregates;
    }
    public function getFileExplanatoryurlAttribute()
    {
        if($this->file_explanatory ==null){

            return '';
        }
        return path($this->id,'courses') .'doc'.'/' . $this->file_explanatory;
    }
    public function getFileWorkurlAttribute()
    {
        if($this->file_work ==null){

            return '';
        }
        return path($this->id,'courses') .'doc'.'/' . $this->file_work;
    }
    public function getFileTesturlAttribute()
    {
        if($this->file_test ==null){

            return '';
        }
        return path($this->id,'courses') .'doc'.'/' . $this->file_test;
    }

    public function comments()
    {
        return $this->morphMany(Comments::class, 'commentable');
    }
    public function ScopeGender(Builder $query)
    {
     $query->whereIn('course_gender',['0',Auth::guard('student')->user()->gender]);
    }
}
