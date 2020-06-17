<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Thumbnail extends Model
{
    public function all_image_home()
    {
        return $this->belongsTo(AllImage::class,'image_id');
    }
}
