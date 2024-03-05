<?php

namespace App\Models;

use App\Traits\UUID;
use App\Scopes\HasActiveScope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Country extends Model
{
    use UUID, HasFactory;
    protected $guarded = [];
    protected $casts = [
        'currency' => 'json',
    ];
    protected static function booted()
    {
        // static::addGlobalScope(new HasActiveScope);
    }
}
