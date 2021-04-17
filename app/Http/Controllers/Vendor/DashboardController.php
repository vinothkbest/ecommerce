<?php

namespace App\Http\Controllers\Vendor;

use App\Models\User;
use App\Models\Order;
use App\Models\Vendor;
use App\Models\Enquiry;
use App\Models\Product;
use App\Models\Transaction;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $products_count=Product::where('id', Auth::id())->count();
        $enquiry_count=Enquiry::where('id', Auth::id())->count();
        $order_count=Order::where('id', Auth::id())->count();
        $transaction_count=Transaction::where('id', Auth::id())->count();

        return view('vendor.dashboard', compact('products_count', 'enquiry_count', 'order_count', 'transaction_count'));
    }
}
