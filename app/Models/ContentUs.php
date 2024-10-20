<?php

namespace App\Models;

use App\Traits\UUID;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContentUs extends Model
{
    use UUID, HasFactory;
    protected $guarded = [];
}
