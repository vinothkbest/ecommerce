<?php

namespace App\Http\Controllers\API\User;

use Responser;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use App\Models\Wishlist;
use App\Models\Product;
use Illuminate\Http\Request;

class WishlistController extends Controller
{
    public function getWishlist(Request $request)
    {
        try {
            $user=$request->user();
            $wishlist=Wishlist::where('user_id', $user->id)->pluck('product_id');
            $user_products=Product::whereIn('id',$wishlist)->selectRaw($this->getRawQuery($user))->get();
            $data['wishlist']=$user_products;
            return Responser::success('Wishlist successfully', $data);
        } catch (Exception $e) {
            return Responser::failed($e->getMessage());
        }
    }
    public function addWishlist(Request $request)
    {
        $validatedData =  Validator::make($request->all(), [
            'product_id' => 'required|exists:products,id',
            'status'=>'required|boolean'
        ]);

        if ($validatedData->fails()) {
            return Responser::failed($validatedData->errors()->first());
        }

        try {
            $user=$request->user();
            $product_id=$request->product_id;
            $status=$request->status;
            $data=[];
            $wishlisted=Wishlist::where('user_id', $user->id)->where('product_id', $product_id)->first();
            if ($status) {
                if (!$wishlisted) {
                    $wishlisted=Wishlist::create(['user_id'=>$user->id,'product_id'=>$product_id]);
                }
                //$data['wishlist']=$wishlisted;
                return Responser::success('Wishlist Created successfully', ['wishlist'=>$wishlisted]);
            } else {
                if ($wishlisted) {
                    $wishlisted->delete();
                }
                //$data['wishlist']=$wishlisted;
                return Responser::success('Wishlist deleted successfully', ['wishlist'=>$wishlisted]);
            }
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
