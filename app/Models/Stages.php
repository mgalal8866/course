<?php

namespace App\Models;

use App\Traits\UUID;
use App\Scopes\HasActiveScope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Stages extends Model
{
    use UUID,HasFactory;
    // ,SoftDeletes;
    protected $guarded = [];

    protected $hidden = ['pivot'];

    public function courses()
    {
        return $this->belongsToMany(Courses::class,'course_stages') ;
    }

    public function childrens()
    {
        return $this->hasMany(self::class, 'parent_id');
    }

    public function _parent()
    {
        return $this->belongsTo(self::class, 'parent_id');
    }
    public function scopeParent($query)
    {
        return $query->whereNull('parent_id');
    }
    public function lessons()
    {
        return $this->belongsToMany(Lessons::class, 'course_stages', 'stage_id','lesson_id')->withTimestamps();
    }
    public function scopeParentonly($query)
    {
        return $query->where('parent_id','!=' , null);
    }
    protected static function booted()
    {
        // static::addGlobalScope(new HasActiveScope);
    }

}
