<?php

namespace App\Models;

use App\Traits\UUID;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoryFCourse extends Model
{
    use UUID,HasFactory;

    protected $fillable = [
        'name','active' ];
}
