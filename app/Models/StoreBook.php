<?php

namespace App\Models;

use App\Traits\UUID;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StoreBook extends Model
{
    use UUID,HasFactory;
    protected $guarded = [];
    public function getImageurlAttribute()
    {
        return $this->image ? path('','book') . $this->image :path('','').'no-imag.png';
    }
    public function category()
    {
        return $this->belongsTo(CategoryBook::class, 'category_id');
    }


}
