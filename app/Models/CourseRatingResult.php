<?php

namespace App\Models;

use App\Traits\UUID;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CourseRatingResult extends Model
{
    use UUID,HasFactory;
    protected $guarded = [];
    public function course()
    {
        return $this->belongsTo(Courses::class,'course_id');
    }
    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }
    public function course_rating_details()
    {
        return $this->hasMany(CourseRatingDetailsResult::class,'course_rating_results_id');
    }
}
