<?php

namespace App\Http\Controllers\CRM;

use App\Models\User;
use App\Models\Brand;
use App\Models\Order;
use App\Models\Vendor;
use App\Models\Enquiry;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Deal;

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
        $users_count = User::count();
        // $vendors_count=Vendor::count();
        $category_count = Category::count();
        $brand_count = Brand::count();
        //$products_count=Product::count();
        //$deals_count=Deal::count();
        //$orders_count = Order::count();
        //$enquiry_count = Enquiry::count();

        return view('admin.dashboard', compact(
            'users_count',
            'category_count',
            'brand_count',
            //'products_count',
            // 'deals_count',
            //'orders_count',
            //'enquiry_count',
        ));
    }
}
