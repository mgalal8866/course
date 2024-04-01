<?php

namespace App\Models;

use App\Traits\UUID;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Blog extends Model
{
    use UUID, HasFactory, SoftDeletes;
    protected $guarded = [];

    public function getImageurlAttribute()
    {
        return path($this->id,'blog') . $this->image;
    }
    
    public function category()
    {
        return $this->belongsTo(CategoryBlog::class);
    }
}
