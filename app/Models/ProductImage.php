<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class ProductImage extends Model
{
    use HasFactory;
    protected $appends = [
        'path'
    ];
    public function getPathAttribute()
    {
        $val = $this->image;
        if ($val && $val !== "" && Storage::disk('local')->exists('images/product_images/' . $val)) {
            return asset('images/product_images/' . $val);
        } else {
            return asset('images/product_images/default-product.jpg');
        }
    }
}
