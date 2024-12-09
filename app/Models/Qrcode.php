<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Qrcode extends Model
{
    use HasFactory;
    protected $guarded = [];
    
    public function group()
    {
        return $this->belongsTo(QrGroup::class, 'group_id');
    }
}
