<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Brand extends Model
{
    use HasFactory;
    public function products()
    {
        return $this->hasMany(Product::class);
    }
    protected $appends=[
        'path'
    ];
    protected $attributes=[
        'status' => 1
    ];
    public function categories()
    {
        return $this->belongsToMany(Category::class)->withTimestamps();
    }
    public function getPathAttribute()
    {
        $val=$this->image;
        if ($val && $val!=="" && Storage::disk('local')->exists('images/brands/'.$val)) {
            return asset('images/brands/'.$val);
        } else {
            return asset('images/brands/default-brand.png');
        }
    }
}
