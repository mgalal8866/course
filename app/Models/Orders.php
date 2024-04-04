<?php

namespace App\Models;

use App\Traits\UUID;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Orders extends Model
{
    use UUID,HasFactory;
    protected $guarded = [];
    public function order_details()
    {
        return $this->belongsTo(OrdersDetails::class,'product_id');
    }
    public function  transaction ()
    {
        return $this->belongsTo(PaymentTransaction::class,'transaction_id');
    }
}
