<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Homepage extends Model
{
    protected $fillable = ['media_id'];

    public function all_image_home()
    {
        return $this->belongsTo(AllImage::class,'image_id');
    }

}
