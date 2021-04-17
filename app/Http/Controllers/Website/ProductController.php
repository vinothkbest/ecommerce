<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use App\Models\Product;
use App\Models\Category;
use App\Models\Unit;
use App\Models\ProductVariant;
use App\Models\Brand;
use App\Models\Wishlist;
class ProductController extends Controller
{
    public function detail($product){

    	$product = Product::where('slug', $product)->first();

    	$more_products = Category::whereHas('products', function($product){
						    		$product->where('status', 1);
						    	})->find($product->categories[0]->id)->products;

    	return view("website.pages.product-detail", compact('product', 'more_products'));
    }

    public function list($category){
    	$category = Category::where('slug', $category)->with(["products"=>function($product){
                $product->with('productMedia')->with(["productVariants" => function($variant){
                    $variant->with('unit');
                }]);

        }])->first();

    	return view("website.pages.products", compact('category'));
    }

    public function products(Request $request){

            $products = Product::whereIn('id', $request->products)->with("productMedia")
                        ->with(["productVariants" => function($variant){
                                $variant->with('unit');
                        }])->paginate(6);

            return view("website.templates.products-list", compact('products'));

    }

    public function filter(Request $request){
            $filter_variants = $request->variants;
            $filter_price_range = $request->price_min;
            $filter_brands = $request->brands;
            if($request->price_min && $request->price_max)
                $filter_price_range = [intval($request->price_min), intval($request->price_max)];
            else
                $filter_price_range = [];

            $products = Product::whereIn('id', $request->products)->with("productMedia")
                        ->with(["productVariants" => function($variant){
                                $variant->with('unit');
                        }])->whereHas("productVariants", function($variant) use($filter_variants, $filter_price_range){
                                if(!empty($filter_variants)){
                                    $variant->whereIn('variant_name', $filter_variants);   
                                }
                                if(!empty($filter_price_range)){
                                     $variant->whereBetween('actual_price', $filter_price_range); 
                                }
                        })->whereHas("brand", function($brand) use($filter_brands){
                                if(!empty($filter_brands)){
                                    $brand->whereIn('brand_name', $filter_brands);   
                                }
                        })->paginate(6);

        return view("website.templates.products-list", compact('products'));
    }
}
