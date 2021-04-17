<?php

namespace App\Models;

use Exception;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
    use HasFactory;
    protected $casts = [
        'restriction' => 'array',
    ];
    protected $fillable=[
        'type',
        'name',
        'validity',
        'amount',
        'restriction',
        'status',
        'description'
    ];
    protected $appends=[
        'image_count'
    ];
    public function getImageCountAttribute()
    {
        try {
            return $this->restriction[0]['upload_count'];
        } catch (Exception $e) {
            return 0;
        }
    }
}
