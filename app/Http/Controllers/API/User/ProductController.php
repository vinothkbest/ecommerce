<?php

namespace App\Http\Controllers\API\User;

use Exception;
use Responser;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use App\Http\Resources\Category as CategoryResource;

class ProductController extends Controller
{
    private function getChild($dataArr)
    {
        return $dataArr->map(function ($q) {
            return $q->getChildren->count()>0?$this->getChild($q->getChildren):$q->id;
        })->toArray();
    }

    public function is_multi_array($arr)
    {
        rsort($arr);
        return isset($arr[0]) && is_array($arr[0]);
    }


    public function getProductList(Request $request)
    {
        $header = $request->header('Authorization','');
        $isUser=Str::startsWith($header,'Bearer ');
        $user=[];
        if($isUser){
            $user=$request->user();
        }
       
        try {
            $data=[];
            $category_tag=$request->filter["category_tag"];
            $brands=$request->filter["brands"];
            $price_range=$request->filter["price_range"];
            $sort_by=$request->sort_by;
            $cat_ids=[];
            if(count($category_tag)>0){
                $sub_cat_id=$category_tag[count($category_tag)-1];
                $category=Category::with(['getChildren.getChildren.getChildren.getChildren.getChildren.getChildren'])->find($sub_cat_id);
                $cat_ids=$category->getChildren->count()>0?$this->getChild($category->getChildren):[$category->id];
                $cat_ids=$this->is_multi_array($cat_ids)?collect($cat_ids)->collapse():$cat_ids;
            }

            $products=Product::when($cat_ids,fn($q)=>$q->where('category_id', $cat_ids))
                    ->when($isUser, fn ($q) =>$q->selectRaw($this->getRawQuery($user)))
                    ->when($brands, fn ($q) =>$q->whereIn('brand_id', $brands))
                    ->when($price_range["min"], fn ($q) =>$q->where('fixed_price', '>=', $price_range["min"]))
                    ->when($price_range["max"], fn ($q) =>$q->where('fixed_price', '<=', $price_range["max"]))
                    ->when($sort_by==0, fn ($q) => $q->withCount(['orderProducts'])->orderByDesc('order_products_count'))
                    ->when($sort_by==1, fn ($q) => $q->orderBy('created_at', 'desc'))
                    ->when($sort_by==2, fn ($q) => $q->orderByDesc('fixed_price'))
                    ->when($sort_by==3, fn ($q) => $q->orderBy('fixed_price'))
                    ->when($sort_by==4, fn ($q) => $q->orderByDesc('discount'));
            $min=(int)$products->min('fixed_price');
            $max=(int)$products->max('fixed_price');
            $products=$products->paginate(10);
            $data['title']='Product List';
            $data['data']=$products->items();
            $pagination['per_page']=$products->perPage();
            $pagination['current_page']=$products->currentPage();
            $pagination['has_pages']=$products->hasPages();
            $pagination['next_page']=$pagination['has_pages']?$pagination['current_page']+1:null;

            $data['pagination']= $pagination;
            $data['filter']= $request->all();
            $data['filter']['filter']['price_limit']=compact('min','max');
            $data['sort_meta_info']=[
                "Popularity",
                "What's New",
                "Price-high to low",
                "Price-low to high",
                "Discount"
            ];
            return Responser::success('Product List', $data);
        } catch (Exception $e) {
            return Responser::failed($e->getMessage());
        }
    }

    public function getProductDetail(Request $request)
    {
        $user=$request->user();
        try {
            $data=[];
            $product=Product::selectRaw($this->getRawQuery($user))->find($request->product_id);

            $data['title']=$product->name;
            $data['data']=$product;
            return Responser::success('Product List', $data);
        } catch (Exception $e) {
            return Responser::failed($e->getMessage());
        }
    }
    private function getRawQuery($user)
    {
        return '*,
            IF((SELECT count(*) FROM enquiries WHERE enquiries.product_id=products.id AND enquiries.user_id='.$user->id.')>0,1,0) as is_enquired,
            IF((SELECT count(*) FROM bags WHERE bags.product_id=products.id AND bags.user_id='.$user->id.')>0,1,0) as is_bag,
            IF((SELECT count(*) FROM wishlists WHERE wishlists.product_id=products.id AND wishlists.user_id='.$user->id.')>0,1,0) as is_wishlisted
            ';
    }
}
