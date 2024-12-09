<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QrGroup extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function qrgroup()
    {
        return $this->belongsTo(qrgroup::class, 'qrgroup_id');
    }
}
