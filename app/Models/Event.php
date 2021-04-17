<?php

namespace App\Models;

use App\Models\Subscription;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Event extends Model
{
    use HasFactory;
    protected $fillable=[
        'subscription_id',
        'name',
        'start_date',
        'end_date',
        'status',
        'description'
    ];
    protected $hidden=[
        'updated_at'
    ];
    protected $casts=[
        'start_date'=>'datetime',
        'end_date'=>'datetime'
    ];
    public function subscription()
    {
        return $this->belongsTo(Subscription::class)->select('id', 'name', 'amount');
    }
}
