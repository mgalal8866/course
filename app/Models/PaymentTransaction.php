<?php

namespace App\Models;

use App\Enum\PaymentStatus;
use App\Models\PaymentOnline;
use App\Models\PaymentOffline;
use App\Traits\UUID;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PaymentTransaction extends Model
{
    use UUID,HasFactory;
    protected $guarded = [];

    protected $casts = ['statu'=>PaymentStatus::class];
    public function paymentable()
    {
        return $this->morphTo();
    }
    public function getImageurlAttribute()
    {
        if($this->image ==null){

            return '';
        }
        return path($this->id,'transaction') .'/' . $this->image;
    }
    public function payment()
    {
        return $this->belongsTo(PaymentMethods::class);
    }
    public function order()
    {
        return $this->belongsTo(PaymentTransaction::class,foreignKey: 'order_id');
    }

}
