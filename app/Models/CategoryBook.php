<?php

namespace App\Models;

use App\Traits\UUID;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoryBook extends Model
{
    use UUID,HasFactory;

    protected $guarded = [];
    public function book()
    {
        return $this->hasMany(StoreBook::class, 'category_id');
    }
    public function country()
    {
        return $this->belongsTo(country::class, 'country_id');
    }
}
