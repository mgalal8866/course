<?php

namespace App\Models;

use App\Traits\UUID;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quiz_question_answers extends Model
{
    use UUID,HasFactory;
    protected $guarded = [];
    public function question()
    {
        return $this->belongsTo(Quiz_questions::class, 'question_id');
    }
}
