<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Cache;

class User extends Authenticatable
{
    use Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'nip','user_name','lokasi_id','active'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function profile()
    {
        return $this->hasOne('App\UserProfiles');
    }

    public function getNameAttribute($value)
    {
        $value = strtoupper($value);
        return $value;
    }

    //return Boolean
    public function isOnline()
    {
        return Cache::has('user-is-online-' . $this->id);
    }
}
