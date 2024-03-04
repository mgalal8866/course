<?php

namespace App\Models;

use App\Enum\Quiz;
use App\Traits\UUID;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CategoryExams extends Model
{
    use UUID, HasFactory, SoftDeletes;
    protected $guarded = [];
    protected $casts = [
        'type' => Quiz::class
    ];

    public function quizz()
    {
        return $this->hasMany(Quizes::class, 'category_id');
    }
}
