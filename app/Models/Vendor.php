<?php

namespace App\Models;

use Hash;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\Storage;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Vendor extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    protected static function boot()
    {
        parent::boot();

        // Order by name ASC
        static::addGlobalScope('order', function (Builder $builder) {
            $builder->orderBy('id', 'desc');
        });
    }
    protected $fillable = [
        'name',
        'mobile_number',
        'contact_number',
        'email',
        'shop_name',
        'gst_number',
        'address',
        'profile_image',
        'gst_document',
        'email_verified_at',
        'gst_verified_at',
        'otp_verified_at',
	'status',
	'password'
    ];

    protected $hidden = [
        'otp',
        'remember_token',
        'otp_verified_at',
        'created_at',
        'updated_at'
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    protected $appends = [
        'gst_verified',
    ];

    public function getProfileImageAttribute($val)
    {
        if ($val && $val!=="" && Storage::disk('local')->has('images/profiles/'.$val)) {
            return asset('/images/profiles/'.$val);
        } else {
            return asset('/images/profiles/default-profile.jpg');
        }
    }

    public function getGstDocumentAttribute($val)
    {
        if ($val && $val!=="" && Storage::disk('local')->has('images/profiles/'.$val)) {
            return asset('/images/documents/'.$val);
        } else {
            return null;
        }
    }

    public function getGstVerifiedAttribute()
    {
        return !empty($this->gst_verified_at);
    }
    public function setPasswordAttribute($val)
    {
        return $this->attributes['password']=Hash::make($val);
    }
}
