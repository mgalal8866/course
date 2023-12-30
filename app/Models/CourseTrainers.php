<?php

namespace App\Models;

use App\Traits\UUID;
use App\Models\Courses;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CourseTrainers extends Model
{
    use UUID, HasFactory,SoftDeletes;

    protected $guarded = [];
    public function course()
    {
        return $this->belongsTo(Courses::class, 'course_id');
    }
}
