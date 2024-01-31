<?php

namespace App\Models;

use App\Traits\UUID;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Stages extends Model
{
    use UUID,HasFactory;
    // ,SoftDeletes;
    protected $guarded = [];

    protected $hidden = ['pivot'];

    public function courses()
    {
        return $this->belongsToMany(Courses::class,'course_stages') ;
    }


    public function lessons()
    {
        return $this->belongsToMany(Lessons::class, 'course_stages',  'stage_id','lesson_id');
    }
}
