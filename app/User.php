<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable

{
    use Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','type','verified',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];


    public function video()
    {
        return $this->hasMany(Video::class);
    }
    public function role()
    {
        return $this->hasOne(Role::class);
    }
    public function profile_picture()
    {
        return $this->hasOne(ProfilePicture::class);
    }
    public function verifyUser()
    {
        return $this->hasOne(VerifyUser::class);
    }
    public function branches()
    {
        return $this->belongsToMany(Branch::class,'branch_user');
    }

    public function hasBranch()
    {
        
    }
}
