<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    protected $attributes = ['status' => 1];
    protected $appends = ['image_path'];
    
    public function postSeo(){
    	return $this->morphOne(SeoList::class, 'contentable');
    }
    public function getImagePathAttribute(){
    	if($this->image) return url("images/posts/" . $this->image);
    	else return 'Null';
    }

    public function categories(){
        return $this->belongsToMany(Category::class);
    }

    public function tags(){
        return $this->belongsToMany(Tag::class);
    }

    public function postedBy(){
        return $this->belongsTo(Admin::class, 'admin_id');
    }
}
