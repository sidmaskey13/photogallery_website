<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable =['name'];
    public function media()
    {
        return $this->morphedByMany(Media::class,'target','category_media');
    }
    public function video()
    {
        return $this->morphedByMany(Video::class,'target','category_media');
    }
}

