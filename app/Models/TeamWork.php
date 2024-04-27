<?php

namespace App\Models;

use App\Traits\UUID;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TeamWork extends Model
{
    use UUID, HasFactory;
    protected $guarded = [];
    public function specialist_r()
    {
        return $this->belongsTo(Specialist::class, 'specialist');
    }
}
