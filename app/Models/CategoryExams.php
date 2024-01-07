<?php

namespace App\Models;

use App\Traits\UUID;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CategoryExams extends Model
{
    use UUID,HasFactory,SoftDeletes;
    protected $fillable = [
        'name','active' ];

        public function quizz()
        {
            return $this->hasMany(Quizzes::class, 'category_id');
        }
}
