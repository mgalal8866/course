<?php

namespace App\Models;

use App\Models\User;
use App\Traits\UUID;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Orders extends Model
{
    use UUID,HasFactory;
    protected $guarded = [];
    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }
    public function order_details()
    {
        return $this->hasMany(OrdersDetails::class,'order_id');
    }
    public function  transaction ()
    {
        return $this->belongsTo(PaymentTransaction::class,'transaction_id');
    }
    public function  coupon ()
    {
        return $this->belongsTo(UserCoupon::class,'code');
    }
}
