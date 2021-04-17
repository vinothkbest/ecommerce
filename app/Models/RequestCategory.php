<?php

namespace App\Models;

use App\Models\Vendor;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class RequestCategory extends Model
{
    use HasFactory;
    public function vendor()
    {
        return $this->belongsTo(Vendor::class);
    }
}
