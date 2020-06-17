<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Watermark extends Model
{
    public function no_watermark_image()
    {
        return $this->belongsTo(AllImage::class,'image_id');
    }
}
