<?php

namespace App\Models;

use App\Enum\NotifiType;
use App\Traits\UUID;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use UUID, HasFactory;
    protected $guarded = [];
    protected $casts = ['type' => NotifiType::class];
    public function  book ()
    {
        return $this->belongsTo(StoreBook::class,'redirect_id');
    }
    public function  course ()
    {
        return $this->belongsTo(Courses::class,'redirect_id');
    }
    public function  order()
    {
        return $this->belongsTo(OrdersDetails::class,'redirect_id');
    }
    public function  user()
    {
        return $this->belongsTo(User::class,'user_id');
    }
    public function getRedirectAttribute()
    {
        if ($this->type->value == 1) {
           return $this->course->name??'';
        } elseif ($this->type->value == 2) {
            return $this->book->book_name??'';
        } elseif ($this->type->value == 3) {
            // return $this->order->name;
        } elseif ($this->type->value == 0) {
            return 'Nothing';
        }
        // if($this->type)
        // return $this->image?path('','payment') . $this->image: path('','').'no-imag.png';
    }
}
