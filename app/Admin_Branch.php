<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Admin_Branch extends Model
{
    protected $fillable = [
        'branch_id', 'target_id', 'target_type'
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
}
