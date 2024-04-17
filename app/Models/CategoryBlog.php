<?php

namespace App\Models;

use App\Traits\UUID;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoryBlog extends Model
{
    use UUID,HasFactory;
    protected $guarded = [];
    public function country()
    {
        return $this->belongsTo(Country::class,'country_id');
    }
    public function blog()
    {
        return $this->hasMany(Blog::class,'category_id');
    }
}
