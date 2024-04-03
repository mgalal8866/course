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
    public function getAuthorImageurlAttribute()
    {
       
        return $this->author_image?path($this->id,'blog/author') . $this->author_image: path('','').'no-imag.png';


    }

    public function category()
    {
        return $this->belongsTo(CategoryBlog::class);
    }
}
