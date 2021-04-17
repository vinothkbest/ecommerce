<?php

namespace App\Http\Controllers\API\User;

use Exception;
use Responser;

use App\Models\Deal;
use App\Models\Brand;
use App\Models\Banner;
use App\Models\Product;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    public function getHomeData()
    {
        $suggestion=[
            "deals",
            "recent_Products",
            "top_brands",
            "best_selling_this_week",
            "products_by_brand"
        ];
        try {
            $data=[];
            /**
             * {
             * label:'Deals of the day',
             * data:[]
             * }
             */


            //Recent products
            $recent_products['label']="Recent Products";
            $recent_products['horizontal']=true;
            $recent_products['type']=3;
	    $recent_products['data_field']="product_id";
            $recent_products_data=Product::select('id','name')->latest()
            ->limit(8)->get()->makeHidden('category','parents_path');
            $recent_products['data']=$recent_products_data;
            $recent_products['data_field']="product_id";

            //deals
            // $deals["label"]="Deals Of the Day";
            // $deals["horizontal"]=true;
            // $deals['type']=3;
            // $deals_data=Deal::get();
            // $deals["data"]=$deals_data;

            //Top Brands
            $top_brands['label']="Top Brands";
            $top_brands['horizontal']=false;
            $top_brands['type']=2;
            //if type==2 need data_field because Product List Contain category_id and brand_id based filter
            $top_brands['data_field']="brand_id";
            $brands=Brand::select('id', 'name', 'image')->withCount(['products as p_count'])->orderByDesc('p_count')->limit(9)->get();
            $top_brands['data']=$brands;

            $data[]=$recent_products;
            //$data[]=$deals;
            $data[]=$top_brands;
            return Responser::success('Home Data', $data);
        } catch (Exception $th) {
            return Responser::failed($th->getMessage());
        }
    }
    public function getBannerData()
    {
        try {
            $data=[];
            $data['meta_info']=['1'=>'CategoryScreen','2'=>'ProductListScreen','3'=>'ProductDetailScreen','4'=>'ExhibitionScreen'];
            $banner=Banner::select('id', 'image', 'type', 'type_id')->get();
            $data['banner']=$banner;
            return Responser::success('Banner Data', $data);
        } catch (Exception $e) {
            return Responser::failed($e->getMessage(),[],500);
        }
    }
}
