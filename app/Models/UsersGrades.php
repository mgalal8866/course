<?php

namespace App\Models;

use App\Traits\UUID;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UsersGrades extends Model
{
    use UUID,HasFactory;
    protected $guarded = [];
       public function category()
       {
           return $this->belongsTo(CategoryGrades::class, 'category_id');
       }
        public function getImageurlAttribute()
    {
        return path('','grades') . $this->image;
    }
}

