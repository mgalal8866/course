<?php

namespace App\Models;

use App\Traits\UUID;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CourseRatingDetailsResult extends Model
{
    use  UUID,HasFactory;
    protected $guarded = [];
    public function courserating()
    {
        return $this->belongsTo(CourseRating::class,'rating_id');
    }

}
