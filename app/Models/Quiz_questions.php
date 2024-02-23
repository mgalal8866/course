<?php

namespace App\Models;

use App\Traits\UUID;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quiz_questions extends Model
{
    use UUID,HasFactory;
    protected $guarded = [];
    public function answer()
    {
        return $this->hasMany(Quiz_question_answers::class,'question_id');
    }
    public function quize()
    {
        return $this->belongsTo(Quizes::class, 'quiz_id');
    }
}
