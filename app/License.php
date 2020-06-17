<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class License extends Model
{
    public function media()
    {
        return $this->hasMany(LicenseMedia::class);
    }
    public function video()
    {
        return $this->hasMany(LicenseVideo::class);
    }

}
