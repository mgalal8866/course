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
    public function question()
    {
        return $this->hasMany(Quiz_questions::class, 'quiz_id');
    }
    public function quizresult()
    {
        return $this->belongsTo(QuizResultHeader::class, 'quiz_id');
    }
}
