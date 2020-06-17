<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LicenseMedia extends Model
{
    protected $fillable = [
        'license_id', 'type', 'media_id'
    ];
    public function media()
    {
        return $this->belongsTo(Media::class,'media_id');
    }
    public function license()
    {
        return $this->belongsTo(License::class,'license_id');
    }


}
