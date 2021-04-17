<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SeoList extends Model
{
    use HasFactory;
    protected $attributes = ['status' => 1];
    protected $appends = ['image_path'];
    public function contentable(){
    	return $this->morphTo();
    }

    public function getImagePathAttribute(){
    	if($this->image) return url("images/seo/" . $this->image);
    	else return 'Null';
    }
}
