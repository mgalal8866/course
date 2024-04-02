<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Traits\UUID;
use App\Models\CourseEnrolleds;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable  implements JWTSubject
{
    use HasApiTokens, HasFactory, Notifiable ,  HasRoles ,UUID, SoftDeletes;


    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $guarded = [];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];
    public function country()
    {
        return $this->belongsTo(Country::class, 'country_id');
    }
    public function user_coupon()
    {
        return $this->hasone(UserCoupon::class, 'user_id');
    }
    public function courseenrolled()
    {
        return $this->hasMany(CourseEnrolleds::class, 'user_id');
    }
    public function aboutus()
    {
        return $this->hasMany(AboutUs::class, 'user_id');
    }
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getImageurlAttribute()
    {
        return $this->image?path('','teamwork') . $this->image: path('','').'no-imag.png';
    }
    public function getJWTCustomClaims()
    {
        return [];
    }
}
