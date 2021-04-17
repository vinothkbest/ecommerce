<?php

namespace App\Models;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Banner extends Model
{
    use HasFactory;
    protected $attributes = ["status" => 1];
    protected $fillable = ["category_id", 'title', 'highligted_text', 'image'];
    protected $appends = ["path"];

    public function category(){
        return $this->belongsTo(Category::class, 'category_id');
    }
    public function getPathAttribute(){
    	if (Storage::disk('local')->exists('images/banners/' . $this->image)) {
              return asset('images/banners/' . $this->image);
        }
        else{
        	return asset('images/banners/default.jpg');
        }
    }
}
