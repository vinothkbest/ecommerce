<?php

namespace App\Models;

use App\Models\User;
use App\Models\OrderProduct;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Carbon\Carbon;

class Order extends Model
{
    use HasFactory;
    protected $attributes = ["admin_status" => 0];
    protected $fillable=[
        "transaction_id","shipping_address", "order_summary", "is_cart"    
    ];
    protected $casts = ["shipping_address" => "collection", "order_summary" => "collection"];
    protected $appends = ["user", "order_id", "ordered_date"];
    public function products()
    {
        return $this->hasMany(OrderProduct::class);
    }
    public function getOrderIdAttribute(){
        $padstr = "KAPAFD" . str_pad($this->id, "8", 0, STR_PAD_LEFT);
        return $padstr;
    }
    public function transaction(){
        return $this->belongsTo(Transaction::class)->with("user");
    }
    // public function userRelation(){

    // }
    public function getUserAttribute(){
        return $this->transaction->user->name;
    }
    public function getOrderedDateAttribute(){
        return Carbon::parse($this->created_at)->format("d-m-Y h:i A");
    }
    public function getDeliveredDateAttribute($date){
        return Carbon::parse($date)->format("d-m-Y h:i A");
    }

    public function getCancelledDateAttribute($date){
        return Carbon::parse($date)->format("d-m-Y h:i A");
    }
}
