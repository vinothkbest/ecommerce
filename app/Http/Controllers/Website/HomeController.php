<?php

namespace App\Http\Controllers\Website;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\ProductVariant;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    public function index()
    {
        $products = Product::where('status', 1)->take(20)->OrderByDesc('created_at')->get();

        return view('website.pages.index', compact('products'));
    }

    public function about(){
        return view('website.pages.about');
    }

    public function cancellationPolicy(){
        return view('website.pages.cancellation-policy');
    }

    public function contact(){
        return view('website.pages.contact');
    }
    public function policy(){
        return view('website.pages.policy');
    }
    public function privacyPolicy(){
        return view('website.pages.privacy-policy');
    }
    public function shippingPolicy(){
        return view('website.pages.shipping-policy');
    }
    public function termsConditions(){
        return view('website.pages.terms-conditions');
    }

    public function search(){

        $bulider = Product::query();

        $terms = explode(" ", $_GET['q']);
        
        foreach ($terms as $key => $term) {
            $bulider->where("product_name", "LIKE", "%" . $term ."%")
                    ->orWhere("description", "LIKE", "%" . $term ."%")
                    ->orWhere("detailed_description", "LIKE", "%" . $term ."%")
                    ->orWhereHas("productSeo", function($seo) use($term){
                            $seo->where('contentable_type', "LIKE", "%" . $term ."%")
                                ->orWhere('title', "LIKE", "%" . $term ."%")
                                ->orWhere('keyword', "LIKE", "%" . $term ."%")
                                ->orWhere('description', "LIKE", "%" . $term ."%");  
                    })
                    ->orWhereHas("categories", function($category) use($term){
                            $category->where('category_name', "LIKE", "%" . $term ."%");  
                    });
        }
        $products = $bulider->OrderByDesc('created_at')->get();
        
        return view('website.pages.product-search', compact('products'));
    }
}
