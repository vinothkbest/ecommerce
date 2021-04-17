<?php

namespace App\Models;

use App\Models\OrderProductVariant;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class OrderProduct extends Model
{
    use HasFactory;
    protected $hidden=[
        'updated_at'
    ];
    protected $casts = [
        'meta' => 'array',
    ];
    protected $fillable=[
        "order_id",
        "product_id",
        "actual_price",
        "total_quantity",
        "total_price",
        "total_variant",
        "meta"
    ];
    public function variants()
    {
        return $this->hasMany(OrderProductVariant::class);
    }
    public function product()
    {
        return $this->belongsTo(Product::class)->select('id', 'vendor_id');
    }
}