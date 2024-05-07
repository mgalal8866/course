<?php

namespace App\Models;

use App\Enum\Quiz;
use App\Traits\UUID;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Lessons extends Model
{
    use UUID, HasFactory, SoftDeletes;
    protected $guarded = [];
    // protected $hidden = ['pivot'];

    public function courses()
    {
        return $this->belongsToMany(Courses::class,'course_stages' ,'lesson_id', 'course_id')->withPivot(['publish_at','course_id']) ;
    }
    public function stages()
    {
        return $this->belongsToMany(Stages::class, 'course_stages', 'lesson_id', 'stage_id')->withPivot(['publish_at','course_id']);
    }
    public function quiz()
    {
        return $this->belongsTo(Quizes::class, 'link_video');
    }
}
