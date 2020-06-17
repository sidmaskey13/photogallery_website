<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AllImage extends Model
{
    public function image_album()
    {
        return $this->belongsTo(Media::class,'media_id');
    }
    public function homepage_images()
    {
        return $this->hasOne(Homepage::class,'image_id');
    }
    public function thumbnail_image()
    {
        return $this->hasOne(Thumbnail::class,'image_id');
    }
    public function watermark_image()
    {
        return $this->hasOne(Watermark::class,'image_id');
    }
}
