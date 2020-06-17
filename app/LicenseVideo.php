<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LicenseVideo extends Model
{
    protected $fillable = [
        'license_id', 'type', 'video_id'
    ];
    public function video()
    {
        return $this->belongsTo(Video::class,'video_id');
    }
    public function license()
    {
        return $this->belongsTo(License::class,'license_id');
    }
}
