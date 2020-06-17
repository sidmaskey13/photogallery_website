<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Media extends Model
{
    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }
    public function category()
    {
        return $this->morphToMany(Category::class,'target');
    }
    public function tag()
    {
        return $this->belongsToMany(Tag::class,'media_tag');
    }
    public function license()
    {
        return $this->hasMany(LicenseMedia::class);
    }
    public function all_image()
    {
        return $this->hasMany(AllImage::class);
    }
    public function branches()
    {
        return $this->morphToMany(Branch::class,'target','admin__branches','branch_id');
    }

    public function admin__branches()
    {
        return $this->hasMany(Admin_Branch::class,'target_id')->where('target_type','media');
    }
    public function category_media()
    {
        return $this->hasMany(CategoryMedia::class,'target_id')->where('target_type','media');
    }

}
