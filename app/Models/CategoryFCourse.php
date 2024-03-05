<?php

namespace App\Models;

use App\Traits\UUID;
use App\Scopes\HasActiveScope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CategoryFCourse extends Model
{
    use UUID,HasFactory,SoftDeletes;
    protected $fillable = [
        'name','active' ];

    public function freecourse()
    {
        return $this->hasMany(FreeCourse::class, 'category_id');
    }

    protected static function booted()
    {
        static::addGlobalScope(new HasActiveScope);
    }
}
