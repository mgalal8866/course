<?php

namespace App\Models;

use App\Traits\UUID;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quizes extends Model
{
    use UUID,HasFactory;
    protected $guarded = [];
    public function category()
    {
        return $this->belongsTo(CategoryExams::class, 'category_id');
    }
    public function course()
    {
        return $this->belongsTo(Courses::class, 'course_id');
    }
    public function question()
    {
        return $this->hasMany(Quiz_questions::class, 'quiz_id');
    }
    public function redirect_up()
    {
        return $this->belongsTo(Courses::class, 'redirect_to_up');
    }
    public function redirect_down()
    {
        return $this->belongsTo(Courses::class, 'redirect_to_down');
    }
    public function quizresult()
    {
        return $this->hasOne(QuizResultHeader::class, 'quiz_id');
    }
    public function getImageurlAttribute()
    {
        return $this->image?path('','Quize') . $this->image: path('','').'no-imag.png';
    }

}
