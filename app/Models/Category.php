<?php

namespace App\Models;

use App\Models\Brand;
use App\Scopes\ActiveScope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{
    use HasFactory;
    protected $filleble=[
        'parent_id',
        'category_name',
        'image',
        'status'
    ];
    protected $appends=[
        'image_path',
    ];
    public function getChildren()
    {
        return $this->hasMany(Category::class, 'parent_id');
    }

    public function subCategories()
    {
        return $this->hasMany(Category::class, 'parent_id');
    }
    public function subCategory(){
        return $this->subCategories()->with('subCategory');
    }
    public function parent()
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }
    public function parentCategories()
    {
        return $this->parent()->with('parentCategories');
    }
    public function products()
    {
        return $this->belongsToMany(Product::class);
    }

    public function brands()
    {
        return $this->belongsToMany(Brand::class);
    }

    public function getImagePathAttribute()
    {
        if ($this->image && $this->image!=="" && Storage::disk('local')->exists('images/category/'.$this->image)) {
            return asset('images/category/'.$this->image);
        } else {
            return asset('images/category/default-category.jpg');
        }
    }
    // public function getLogoPathAttribute()
    // {
    //     $val=$this->logo;
    //     if ($val && $val!=="" && Storage::disk('local')->exists('images/category/'.$val)) {
    //         return asset('images/category/'.$val);
    //     } else {
    //         return asset('images/category/default-logo.png');
    //     }
    // }

    protected static function booted()
    {
        static::addGlobalScope(new ActiveScope);
    }
}