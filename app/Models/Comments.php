<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comments extends Model
{
    use HasFactory;
    protected $guarded = [];

   public function commentable()
    {
        return $this->morphTo();
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function courses()
    {
        return $this->belongsTo(Courses::class);
    }
    public function freecourses()
    {
        return $this->belongsTo(FreeCourse::class);
    }

}
