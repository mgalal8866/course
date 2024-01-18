<?php

namespace App\Models;

use App\Traits\UUID;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{
    use UUID, HasFactory, SoftDeletes;
    protected $fillable =
    [
        'name',
        'active',
        'image'
    ];
    public function getImageurlAttribute()
    {
        return path($this->id,'category') . $this->image;
    }

    public function courses()
    {
        return $this->hasMany(Courses::class, 'category_id');
    }
}
