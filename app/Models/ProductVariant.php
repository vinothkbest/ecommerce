<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductVariant extends Model
{
    use HasFactory;

    protected $appends = ["product_name", "weight","gst_tax", "amount_after_tax", "order_product_image"];

    public function unit()
    {
        return $this->belongsTo(Unit::class);
    }
    public function getUnitNameAttribute(){
    	return $this->unit->unit_name;
    }
    public function product(){
    	return $this->belongsTo(Product::class, 'product_id')->with("productCoverImage");
    }
    public function getOrderProductImageAttribute(){
        return $this->product->productCoverImage->image;
    }
    public function getWeightAttribute(){
        return $this->variant_name . " " . $this->unit->unit_name;
    }
    public function getProductNameAttribute(){
        return $this->product->product_name;
    }
    public function getGstTaxAttribute(){
        return $this->product->gst_tax;
    }
    public function getAmountAfterTaxAttribute(){
        return $this->selling_price * (100+$this->product->gst_tax)/100;
    }
}
