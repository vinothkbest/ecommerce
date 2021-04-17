<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Deal extends Model
{
    use HasFactory;
    protected $hidden=[
        'updated_at',
        'created_at',
    ];
    protected $casts=[
        'start_datetime'=>'datetime',
        'end_datetime'=>'datetime'
    ];
}
