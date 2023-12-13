<?php

namespace App\Models;

use App\Traits\UUID;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Blog extends Model
{
    use UUID, HasFactory, SoftDeletes;
    protected $fillable =
    [
        'title',
        'image',
        'short',
        'article',
        'category_id',
        'active',
    ];
}
