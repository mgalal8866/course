<?php

namespace App\Models;

use App\Traits\UUID;
use App\Scopes\HasActiveScope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Trainer extends Model
{
    use UUID,HasFactory,SoftDeletes;
    protected $fillable = [
        'name'    ,
        'phone'   ,
        'email'    ,
        'balance' ,
        'country_id' ,
        'gender'  ,
        'specialist_id',
        'active'  ,
    ];

    public function specialist()
    {
        return $this->belongsTo(Specialist::class, 'specialist_id');
    }
    public function country()
    {
        return $this->belongsTo(Country::class, 'country_id');
    }
    protected static function booted()
    {
        // static::addGlobalScope(new HasActiveScope);
    }
}
