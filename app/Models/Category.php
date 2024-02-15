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
        return $this->image?path('','category') . $this->image: path('','').'no-imag.png';
    }

    public function courses()
    {
        return $this->hasMany(Courses::class, 'category_id');
    }
}
