<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProfilePicture extends Model
{
    public function user_profile()
    {
        return $this->belongsTo(User::class,'user_id');
    }
}
