<?php

namespace App\Models;

use App\Enum\PaymentType;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentMethods extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $casts = ['type'=>PaymentType::class];
    public function payment()
    {
        return $this->morphMany(PaymentTransaction::class, 'paymentable');
    }
    public function getImageAttribute($value)
    {
        return   $value != null ?asset('/asset/images/' . $value):'';
    }
}
