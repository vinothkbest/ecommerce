<?php

namespace App\Models;

use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\Storage;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens,HasFactory, Notifiable;
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
        'mobile',
        'email',
        'password',
        'otp',
        'otp_created_at',
        'crosscheck'

    ];
    protected $hidden = [
        'otp',
        'remember_token',
        'otp_verified_at',
        'created_at',
        'updated_at',
        'password',
    ];
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    protected $appends = [
        'gst_verified',
    ];
    protected $attributes = ["otp_verification_status" => 0, "status" => 0];

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
        if ($val && $val!=="" && Storage::disk('local')->has('images/documents/'.$val)) {
            return asset('/images/documents/'.$val);
        } else {
            return null;
        }
    }
    public function getGstVerifiedAttribute()
    {
        return !empty($this->gst_verified_at);
    }

    public function addresses(){
        return $this->hasMany(Address::class, 'user_id');
    }
}