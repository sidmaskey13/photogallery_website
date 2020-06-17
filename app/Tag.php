<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected $fillable= [
        'name'
    ];
    public function media()
    {
        return $this->belongsToMany(Media::class,'media_tag');
    }
    public function video()
    {
        return $this->belongsToMany(Video::class,'tag_video');
    }

    public function getRouteKeyName()
    {
        return 'name';
    }
}
