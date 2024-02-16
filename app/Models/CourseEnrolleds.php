<?php

namespace App\Models;

use App\Traits\UUID;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CourseEnrolleds extends Model
{
    use UUID,HasFactory;
    protected $guarded = [];

    public function course()
    {
        return $this->belongsTo(Courses::class, 'course_id');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
