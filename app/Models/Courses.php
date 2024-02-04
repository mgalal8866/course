<?php

namespace App\Models;

use App\Traits\UUID;
use App\Models\CourseTrainers;
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
        return path($this->id,'courses') . $this->image;
    }

}
