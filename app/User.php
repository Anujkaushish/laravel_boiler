<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Tymon\JWTAuth\Contracts\JWTSubject;
use App\Models\Coaching;

class User extends \TCG\Voyager\Models\User implements MustVerifyEmail, JWTSubject
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 
        'email', 
        'password', 
        'device_type', 
        'device_token', 
        'google_id', 
        'facebook_id', 
        'is_active', 
        'latitude', 
        'longitude'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

//         public function bikes(){
//         return $this->hasMany(Bike::class);
//     }
// }


    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts =[
        'email_verified_at' => 'datetime',
    ];

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }
    
    public function getJWTCustomClaims()
    {
        return [];
    }

    public function isActive()
    {
        return ($this->is_active == 0) ? false : true;
    }
    public function coachings()
    {
        return $this->hasOne(\App\Models\Coaching::class, 'id', 'tech_id');
    }
}
