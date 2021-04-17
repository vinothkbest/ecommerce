<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Transaction extends Model
{
    use HasFactory;
    
    protected $fillable = ["user_id", "txn_id", "payumoney_id", "product_info", "pay_mode", "email", "mobile", "customer_name", "ordered_price", "capture_status", "pay_status", "bank_ref_num", "is_refund"];

    public function user(){
    	return $this->belongsTo(User::class);
    }
}
