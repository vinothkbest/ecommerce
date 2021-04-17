<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderProductVariant extends Model
{
    use HasFactory;
    protected $hidden=[
        'created_at',
        'updated_at'
    ];
    protected $fillable=[
        "order_product_id",
        "order_id",
        "size",
        "color",
        "quantity",
        "actual_price",
        "total_price"
    ];
}