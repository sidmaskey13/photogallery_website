<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    public function user_video()
    {
        return $this->belongsTo(User::class,'user_id');
    }
    public function category()
    {
        return $this->morphToMany(Category::class,'category_media');
    }
    public function tag_video()
    {
        return $this->belongsToMany(Tag::class,'tag_video');
    }
    public function license()
    {
        return $this->hasMany(LicenseVideo::class);
    }
    public function homepage_video()
    {
        return $this->hasOne(Homepage::class);
    }
    public function all_video()
    {
        return $this->hasMany(AllVideo::class);
    }
    public function branches()
    {
        return $this->morphToMany(Branch::class,'target','admin__branches','branch_id');
    }

    public function admin__branches()
    {
        return $this->hasMany(Admin_Branch::class,'target_id')->where('target_type','video');
    }
    public function category_media()
    {
        return $this->hasMany(CategoryMedia::class,'target_id')->where('target_type','video');
    }
}
