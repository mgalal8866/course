<?php

namespace App\Models;

use App\Traits\UUID;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Slider extends Model
{
    use UUID,HasFactory,SoftDeletes;
    protected $guarded = [];

    public function getImageurlAttribute()
    {
        return path('','slider') . $this->img;
    }
}
