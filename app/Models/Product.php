<?php

namespace App\Models;

use App\Models\Bag;
use App\Models\Brand;
use App\Models\Vendor;
use App\Models\Enquiry;
use App\Models\Category;
use App\Models\Wishlist;
use App\Models\ProductImage;
use App\Models\ProductVariant;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    private $categoryPath;
    public $categoryPathId;

    use HasFactory;
    protected $casts = [
        'highlight' => 'array',
        'specification' => 'array',
        'available_color' => 'array',
        'available_size' => 'array',
        'is_wishlisted' => 'boolean',
        'is_bag' => 'boolean',
        'is_enquired' => 'boolean'
    ];
    protected $hidden = [
        'updated_at',
    ];
    // protected $appends = [
    //     'parents_path',
    //     'brand_name',

    // ];

    public function productCoverImage()
    {
        return $this->hasOne(ProductImage::class, 'product_id')->select('id', 'product_id', 'image');
    }

    //Prodyuct hasMany Relationship functions
    public function productMedia()
    {
        return $this->hasMany(ProductImage::class, 'product_id')->select('id', 'product_id', 'image');
    }


    public function singleVariant()
    {
        return $this->hasOne(ProductVariant::class);
    }
    public function enquiry()
    {
        return $this->hasMany(Enquiry::class);
    }
    public function bag()
    {
        return $this->hasMany(Bag::class);
    }

    public function productVariants()
    {
        return $this->hasMany(ProductVariant::class, 'product_id');
    }

    public function wishlist()
    {
        return $this->hasMany(Wishlist::class);
    }
    public function orderProducts()
    {
        return $this->hasMany(OrderProduct::class);
    }

    //Product Belonging relationships Model
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function categories()
    {
        return $this->belongsToMany(Category::class)->withTimestamps();
    }

    public function vendor()
    {
        return $this->belongsTo(Vendor::class);
    }
    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    public function categoryProduct()
    {
        return $this->belongsToMany(Category::class, 'category_product', 'product_id', 'category_id');
    }

    public function getBrandNameAttribute()
    {
        if ($this->brand_id) {
            return $this->brand->name;
        } else {
            return '';
        }
    }


    //extra functions
    private function getParent($data)
    {
        if ($data) {
            $this->categoryPath->push(["id" => $data->id, "name" => $data->name]);
            $this->getParent($data->parent);
        }
    }

    public function productSeo(){
        return $this->morphOne(SeoList::class, 'contentable');
    }
}
