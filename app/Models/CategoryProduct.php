<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\Pivot

class CategoryProduct extends Pivot
{
    use HasFactory;
    //protected $table = "category_product";
}
