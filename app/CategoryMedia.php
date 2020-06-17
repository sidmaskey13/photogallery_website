<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CategoryMedia extends Model
{
    protected $fillable = [
        'category_id', 'target_id', 'target_type'
    ];
    public function target()
    {
        return $this->morphTo();
    }

    public function media()
    {
        return $this->morphedByMany(Media::class,'target');
    }
    public function video()
    {
        return $this->morphedByMany(Video::class,'target');
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
