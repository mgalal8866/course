<?php

namespace App\Models;

use App\Models\User;
use App\Traits\UUID;
use App\Models\StoreBook;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Cart extends Model
{
    use UUID,HasFactory;
    protected $guarded = [];
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function cart_details()
    {
        return $this->hasMany(CartDetails::class,'cart_header');
    }

}
