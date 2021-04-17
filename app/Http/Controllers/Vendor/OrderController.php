<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function index()
    {
        $orders=Order::whereHas('products.product', function ($q) {
            return $q->where('vendor_id', Auth::guard('vendor')->id());
        })->with('user')->get();
        //return $orders;
        return view('vendor.pages.orders.index', compact('orders'));
    }


    public function show($id)
    {
        $order=Order::select('id', 'user_id', 'total_price', 'status', 'created_at')
        ->with(['products'=>fn ($q) =>$q->where('meta->vendor_id', Auth::guard('vendor')->id()),'products.product.vendor'=>fn ($query) =>$query->select('id', 'name'),'products.variants','user'])
        ->find($id);
        //return $order;
        return view('vendor.pages.orders.show', compact('order'));
    }
}
