<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'door_number', 'street', 'area', 'city', 'state', 'country', 'pin_code', 'is_default', 'status'];

    protected $attributes = [ 'status' => 1 ];
}
