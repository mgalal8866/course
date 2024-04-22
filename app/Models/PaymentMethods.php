<?php

namespace App\Models;

use App\Enum\PaymentType;
use App\Traits\UUID;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentMethods extends Model
{
    use UUID,HasFactory;
    protected $guarded = [];
    protected $casts = ['type'=>PaymentType::class];
    public function payment()
    {
        return $this->morphMany(PaymentTransaction::class, 'paymentable');
    }
    public function getImageurlAttribute()
    {
        return $this->image?path('','payment') . $this->image: path('','').'no-imag.png';
    }
    // public function getImageAttribute($value)
    // {
    //     return   $value != null ?asset('/asset/images/' . $value):'';
    // }
}
