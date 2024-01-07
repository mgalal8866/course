<?php

namespace App\Models;

use App\Traits\UUID;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quizzes extends Model
{
    use UUID,HasFactory;
    protected $guarded = [];
    public function category()
    {
        return $this->belongsTo(CategoryExams::class, 'category_id');
    }

}
