<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AllVideo extends Model
{
    public function video_album()
    {
        return $this->belongsTo(Video::class,'video_id');
    }
    public function homepage_videos()
    {
        return $this->hasMany(Homepage::class,'video_id');
    }
}
