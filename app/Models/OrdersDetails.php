<?php

namespace App\Models;

use App\Traits\UUID;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class OrdersDetails extends Model
{
    use UUID,HasFactory;
    protected $guarded = [];

    public function book()
    {
        return $this->belongsTo(StoreBook::class,'product_id');
    }
    public function course()
    {
        return $this->belongsTo(Courses::class,'product_id');
    }
    public function  coupon ()
    {
        return $this->belongsTo(UserCoupon::class,'coupon_id');
    }
    public function  order ()
    {
        return $this->belongsTo(Orders::class,'order_id');
    }
}
