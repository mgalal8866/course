<?php

namespace App\Models;
use Illuminate\Support\Facades\Auth;
use App\Enum\TypeBook;
use App\Traits\UUID;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StoreBook extends Model
{
    use UUID,HasFactory;
    protected $guarded = [];

    public function getImageurlAttribute()
    {
        return $this->image ? path('','book') . $this->image :path('','').'no-imag.png';
    }
    public function category()
    {
        return $this->belongsTo(CategoryBook::class, 'category_id');
    }
    public function orderdetails()
    {
        return $this->hasOne(OrdersDetails::class, 'product_id')->where('user_id',Auth::guard('student')->user()->id);
    }


}
