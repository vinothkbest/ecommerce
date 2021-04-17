<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ProductVariant;
use App\Models\Order;
use App\Models\Address;
use App\Models\Cart;
use App\Models\Transaction;
use App\Models\User;
use Storage;
use Auth;

class UserOrderController extends Controller
{
    public function makePayment(Request $request){

        if(empty($request->variant)){
            $cart = Cart::where('user_id', Auth::id())->get();
            $order_summary = $cart->makeHidden(["updated_at", "product", "unit", "variant"]);

            $amount = intval($cart->sum("amount_after_tax"));
        }
        else{
            $order_summary = ProductVariant::find(intval($request->variant))->makeHidden(["updated_at", "product", "unit", "available_quantity_count", "availablity_status", "variant_name"]);
            $amount = intval($order_summary->amount_after_tax);
        }

        $data = ['key'=>env('KAPA_KEY'),
                 'txnid'=>bin2hex(random_bytes(10)),
                 'amount'=>$amount,
                 'firstname'=>Auth::user()->name,
                 'email'=>Auth::user()->email,
                 'phone'=>Auth::user()->mobile,
                 'productinfo'=>json_encode($order_summary),
                 'surl'=>url('api/payment-success'),
                 'furl'=>url('api/payment-failure'),
                 'service_provider'=>'payu_paisa',
            ];

        //payumoney hashing
            
        $hashsequesnce =  $data['key'] . "|" .  $data['txnid'] . "|" . $data['amount'] . "|" . $data['productinfo'] . "|"
                      . $data['firstname'] . "|" . $data['email'] . "|||||||||||" . env('KAPA_SALT');

        $hash = strtolower(hash('sha512', $hashsequesnce));

        return view('website.payments.form',compact('hash','data'));
    }

    public function paySuccess(Request $request){
            $user = User::where("mobile", $request->request->get('phone'))->first();
            $productinfo = json_decode($request->request->get('productinfo'));

            $txn_details = ["user_id" => $user->id,
                            "txn_id" => $request->request->get('txnid'),
                            "payumoney_id" => $request->request->get('payuMoneyId'),
                            "email" => $request->request->get('email'),
                            "mobile" => $request->request->get('phone'),
                            "customer_name" => $request->request->get('firstname'),
                            "ordered_price" => $request->request->get('amount'),
                            "pay_mode" => ($request->request->get('mode') == "CC")? "credit card" : "debit card",
                            'capture_status' => $request->request->get('unmappedstatus'),
                            "bank_ref_num" =>  $request->request->get('bank_ref_num'),
                            "pay_status" => $request->request->get('status')];
            
            
            $transaction = Transaction::create($txn_details);
            
            $shipping_address = json_encode(Address::where(["user_id" => $user->id, "is_default" => 1])->first());
            $order_details = [ "transaction_id" =>$transaction->id,
                               "order_summary" => $request->request->get('productinfo'),
                               "shipping_address"=> $shipping_address];
            /**
            * @var $productinfo->id checks cart? or direct buy? 
            */
            if(isset($productinfo->id)){
                
                $order_details["is_cart"] = 0;
                if(!Storage::disk('local')->exists('images/orders/' . $productinfo->order_product_image)) {
                        
                    Storage::copy('images/product_images/'.$productinfo->order_product_image , 'images/orders/' . $productinfo->order_product_image);
                }
                $variant=ProductVariant::find(intval($productinfo->id));
                $variant->available_quantity_count = $variant->available_quantity_count -1;
                $variant->save();
                if($variant->available_quantity_count == 0){
                    $variant->availablity_status = 0;
                    $variant->save();
                }
                
                Order::create($order_details);
            }
            else{
                $order_details["is_cart"] = 1;
                foreach($productinfo as $info) {
                   if(!Storage::disk('local')->exists('images/orders/' . $info->order_product_image)) {
                        
                        Storage::copy('images/product_images/'.$info->order_product_image , 'images/orders/' . $info->order_product_image);
                   }
                   $variant=ProductVariant::find(intval($info->product_variant_id));
                   $variant->available_quantity_count = $variant->available_quantity_count - $info->items;
                   $variant->save();
                   if($variant->available_quantity_count == 0){
                        $variant->availablity_status = 0;
                        $variant->save();
                    }
                }
                Order::create($order_details);
                
                Cart::where('user_id', $user->id)->delete();
            }

            return redirect("user/my-order")->with("success", "Your Order has been received!. We will deliver soon");
    }

    public function payFailure(Request $request){
            $user = User::where("mobile", $request->request->get('phone'))->first();
            
            $txn_details = ["user_id" => $user->id, "product_info"=>$request->request->get('productinfo'),
                            "txn_id" => $request->request->get('txnid'),
                            "payumoney_id" => $request->request->get('payuMoneyId'),
                            "email" => $request->request->get('email'),
                            "mobile" => $request->request->get('mobile'),
                            "customer_name" => $request->request->get('firstname'),
                            "ordered_price" => $request->request->get('amount'),
                            "pay_mode" => ($request->request->get('mode') == "CC")? "credit card" : "debit card",
                            "capture_status" => $request->request->get('unmappedstatus'),
                            "bank_ref_num" =>  $request->request->get('bank_ref_num'),
                            "pay_status" => $request->request->get('status')];
            
            if($request->request->get('unmappedstatus') != "userCancelled"){
                $txn_details["is_refunded"]=0;
            }
            
            Transaction::create($txn_details);

            return redirect('user/my-order')->with("error", "Your Transaction has been failed. Please retry");
    }

    public function myOrder(){

        return view("website.pages.myorder");
    }
}
