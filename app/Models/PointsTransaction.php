<?php

namespace App\Models;

use App\Traits\UUID;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PointsTransaction extends Model
{
    use UUID,HasFactory;
    protected $guarded = [];

}
