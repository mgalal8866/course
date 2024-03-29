<?php

namespace App\Models;

use App\Traits\UUID;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AboutUs extends Model
{
    use UUID, HasFactory;

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
