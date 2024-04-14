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
    public function payment()
    {
        // return $this->belongsTo(PaymentMethodCredentials::class);
    }

}
