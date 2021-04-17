<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'product_id', 'product_variant_id', 'items'];
    protected $attributes = ['items' => 1];
    protected $appends = ["product_name", "weight", "actual_price", "discount_price", "selling_price", "gst_tax", "amount_after_tax", "order_product_image"];

    public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }
    
    public function product(){
    	return $this->belongsTo(Product::class, 'product_id')->with("productCoverImage");
    }
    public function variant(){
    	return $this->belongsTo(ProductVariant::class, 'product_variant_id');
    }
    public function unit(){
        return $this->belongsTo(ProductVariant::class, 'product_variant_id')->with('unit');
    }
    public function getProductNameAttribute(){
        return $this->product->product_name;
    }
    public function getOrderProductImageAttribute(){
        return $this->product->productCoverImage->image;
    }
    public function getWeightAttribute(){
        return $this->variant->variant_name . " " . $this->unit->unit_name;
    }
    public function getActualPriceAttribute(){
        return $this->variant->actual_price * $this->items;
    }
    public function getDiscountPriceAttribute(){
        return $this->variant->discount_price * $this->items;
    }
    public function getSellingPriceAttribute(){
        return $this->variant->selling_price * $this->items;
    }
    public function getGstTaxAttribute(){
        return $this->product->gst_tax;
    }
    public function getAmountAfterTaxAttribute(){
        return $this->variant->selling_price * (100+$this->product->gst_tax)/100 * $this->items;
    }

}   
