<?php

namespace App\Models;

use App\Traits\UUID;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\File;
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

        $p =  '/files' . '/' . 'blog' . '/' . $this->id. '/author'.'/';
        $path = asset($p) ;
        if (!File::exists($path)) {
            mkdir($path, 0777, true);
        }
        return $this->author_image? $path. '/'. $this->author_image: path('','').'no-imag.png';


    }

    public function category()
    {
        return $this->belongsTo(CategoryBlog::class);
    }
}
