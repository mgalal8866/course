<?php

namespace App\Models;

use App\Traits\UUID;
use App\Scopes\HasActiveScope;
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
    protected static function booted()
    {
        static::addGlobalScope(new HasActiveScope);
    }
    public function getImageurlAttribute()
    {
        return $this->image?path('','category') . $this->image: path('','').'no-imag.png';
    }
    public function country()
    {
        return $this->belongsTo(Country::class, 'country_id');
    }
    public function courses()
    {
        return $this->hasMany(Courses::class, 'category_id');
    }
}
