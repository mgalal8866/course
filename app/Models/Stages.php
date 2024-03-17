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
        return $this->belongsToMany(Courses::class,'course_stages','stage_id','course_id') ;
    }
    public function coursesparent_id()
    {
        return $this->belongsToMany(Courses::class,'course_stages','stage_id','course_id','parent_id') ;
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
        return $this->belongsToMany(Lessons::class, 'course_stages', 'stage_id','lesson_id')->withPivot('publish_at')->withTimestamps();
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
