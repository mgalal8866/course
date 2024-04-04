<?php

namespace App\Models;

use App\Traits\UUID;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CartDetails extends Model
{
    use UUID, HasFactory;
    protected $guarded = [];
    public function cart()
    {
        return $this->belongsTo(cart::class,'cart_header');
    }
    public function book()
    {
        return $this->belongsTo(StoreBook::class,'product_id');
    }
    public function course()
    {
        return $this->belongsTo(Courses::class,'product_id');
    }
}
