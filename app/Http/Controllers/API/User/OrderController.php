<?php

namespace App\Http\Controllers\API\User;

use Responser;
use App\Models\Bag;
use App\Models\Order;
use App\Models\Product;
use App\Models\OrderProduct;
use Illuminate\Http\Request;
use App\Models\OrderProductVariant;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class OrderController extends Controller
{
    public function getOrders(Request $request)
    {
        try {
            $user=$request->user();
            $orders=Order::where('user_id', $user->id)->get();
            $data['orders']=$orders;
            return Responser::success('Order successfully', $data);
        } catch (Exception $e) {
            return Responser::failed($e->getMessage());
        }
    }
    public function getOrderProducts(Request $request)
    {
        $validatedData =  Validator::make($request->all(), [
            'order_id'=>'required|exists:orders,id',
        ]);

        if ($validatedData->fails()) {
            return Responser::failed($validatedData->errors()->first());
        }
        try {
            $user=$request->user();
            $order_id=$request->order_id;
            $order_products=OrderProduct::where('order_id', $order_id)->get();
            $data['order_products']=$order_products;
            return Responser::success('Order product successfully', $data);
        } catch (Exception $e) {
            return Responser::failed($e->getMessage());
        }
    }
    public function getOrderProductVariants(Request $request)
    {
        $validatedData =  Validator::make($request->all(), [
            'order_product_id'=>'required|exists:order_products,id',
        ]);

        if ($validatedData->fails()) {
            return Responser::failed($validatedData->errors()->first());
        }
        try {
            $user=$request->user();
            $order_product_id=$request->order_product_id;
            $order_product=OrderProductVariant::where('order_product_id', $order_product_id)->get();
            $data['order_product_variants']=$order_product;
            return Responser::success('Order variants successfully', $data);
        } catch (Exception $e) {
            return Responser::failed($e->getMessage());
        }
    }
    public function addOrder(Request $request)
    {
        $validatedData =  Validator::make($request->all(), [
            'total_price'=>'required',
            'total_product'=>'required',
            'products' => 'required|array|min:1',
        ]);

        if ($validatedData->fails()) {
            return Responser::failed($validatedData->errors()->first());
        }
        try {
            $user=$request->user();
            $placed_orders=$request;
            $order=Order::create(['total_price'=>$placed_orders->total_price,'user_id'=>$user->id,'total_product'=>$placed_orders->total_product]);
            $products=$placed_orders->products;
            foreach ($products as $key=>$product) {
                $product_meta_data=Product::find($product["product_id"]);
                $orderProduct=OrderProduct::create([
                    'order_id'=>$order->id,
                    'product_id'=>$product["product_id"],
                    'actual_price'=>$product["actual_price"],
                    'total_quantity'=>$product["total_quantity"],
                    'total_price'=>$product["total_price"],
                    'total_variant'=>$product["total_variant"],
                    'meta'=>$product_meta_data]);
                foreach ($product["variants"] as $varKey=>$variant) {
                    $orderProductVariant=OrderProductVariant::create([
                        "order_product_id"=>$orderProduct->id,
                        "order_id"=>$order->id,
                        "size"=>$variant["size"],
                        "color"=>$variant["color"],
                        "quantity"=>$variant["quantity"],
                        "actual_price"=>$variant["actual_price"],
                        "total_price"=>$variant["total_price"],
                    ]);
                }
            }
            Bag::where('user_id', $user->id)->delete();
            return Responser::success('Order Created Successfully', ["order"=>$order]);
        } catch (Exception $e) {
            return Responser::failed($e->getMessage());
        }
    }
}