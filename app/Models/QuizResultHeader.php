<?php

namespace App\Models;

use App\Enum\Quiz;
use App\Traits\UUID;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuizResultHeader extends Model
{
    use UUID,HasFactory;
    protected $guarded = [];
    protected $casts = ['history' => 'array'];

    public function quiz_result_details()
    {
        return $this->hasMany(QuizResultDetails::class,'result_header_id');
    }
    public function quiz()
    {
        return $this->belongsTo(Quizes::class,'quiz_id');
    }
}
