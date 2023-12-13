<?php

namespace App\Models;

use App\Traits\UUID;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Specialist extends Model
{
    use UUID, HasFactory;
    protected $fillable = [
        'name',
        'active',
    ];

    public function trainer()
    {
        return $this->hasMany(Trainer::class, 'specialist_id');
    }

}
