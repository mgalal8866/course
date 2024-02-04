<?php

namespace App\Models;

use App\Traits\UUID;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class FreeCourse extends Model
{
    use UUID, HasFactory,SoftDeletes;

    protected $fillable = [
        'name',
        'active',
        'image',
        'description',
        'video_link',
        'category_id'
    ];

    public function category()
    {
        return $this->belongsTo(CategoryFCourse::class, 'category_id');
    }
    public function getImageurlAttribute()
    {
        return path($this->id,'free_courses') . $this->image;
    }
}
