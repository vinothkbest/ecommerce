<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ProductVariant;
use App\Models\Product;
use App\Models\Cart;
use App\Models\Address;
use Auth;

class CartController extends Controller
{
    public function items(){
    	$carts = Cart::where('user_id', Auth::id())->get();
    	return view('website.pages.add-to-cart', compact('carts'));
    }
    public function shippingDetail(){
    	$where = ['user_id' => Auth::id(), 'is_default' => 1];
    	$shipping_address = Address::where($where)->first();
        /**
        * @return cart if not set $_GET['variant'];
        */

        if(!isset($_GET['variant'])){

            $shipping_summary = Cart::where('user_id', Auth::id())->get()->makeHidden(["updated_at", "product", "unit", "variant"]);
        }
        else{
            $shipping_summary = ProductVariant::find(intval($_GET['variant']))->makeHidden(["updated_at"]);
        }

    	return view('website.pages.shipping-details', compact('shipping_address', 'shipping_summary'));
    }
    public function addTo(Request $request){
    	if($request->type == "new-item"){
    		$selling_price = ProductVariant::find($request->variant_id)->selling_price;
    		$where = ['product_variant_id'=> $request->variant_id, 'user_id' => Auth::id()];
    		$has_user_cart_variant = Cart::where($where);

    		if(!$has_user_cart_variant->first()){

    			$new_cart = ['user_id' => Auth::id(), 'product_id' => $request->product_id, 'product_variant_id' => $request->variant_id];
	    	
	    		Cart::create($new_cart);
    		}
    		return redirect()->route('user.cart.itmes');
	    	
    	}
    	elseif($request->type == "update-items"){
    		foreach ($request->cart_ids as $key => $cart_id) {
    			$update_cart = ["items" => intval($request->items[$key]), 'product_variant_id' => intval($request->variant_ids[$key])]; 
    			Cart::where('id', $cart_id)->update($update_cart);
    		}
    		return redirect()->route('user.shipping.detail');
    	}
    	
    }

    public function removeCart($cart){
    	Cart::find($cart)->delete();
    	return response()->json(['status' => true, 'message' => "Cart has been removed!",],200);
    }
}
