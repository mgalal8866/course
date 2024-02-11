<?php

namespace App\Models;

use App\Traits\UUID;
use App\Models\UsersGrades;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CategoryGrades extends Model
{
    use UUID,HasFactory;
    protected $guarded = [];
    public function grades()
    {
        return $this->hasOne(UsersGrades::class, 'category_id');
    }
   
}
