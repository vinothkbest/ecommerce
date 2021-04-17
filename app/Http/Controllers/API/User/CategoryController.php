<?php

namespace App\Http\Controllers\API\User;

use Exception;
use Responser;

use App\Models\Brand;
use App\Models\Category;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\Category as CategoryResource;

class CategoryController extends Controller
{
    public function getCategory()
    {
        try {
            		   $category=CategoryResource::collection(Category::whereNull('parent_id')->with(['getChildren.getChildren.getChildren.getChildren.getChildren.getChildren'])->get());
            $data["category"]=$category;
            return Responser::success('Category List', $data);
        } catch (Exception $e) {
            return Responser::failed($e->getMessage());
        }
    }

    public function getCategoryList(Request $request)
    {
        $validatedData =  Validator::make($request->all(), [
            'category_id' => 'required|exists:categories,id',
        ]);

        if ($validatedData->fails()) {
            return Responser::failed($validatedData->errors()->first());
        }
        $category_id=$request->category_id;
        try {
            $data=[];
            $category_data=[];

            $category=Category::select('id', 'parent_id', 'name', 'banner', 'logo')
                      ->with(['brands:id,name,image','subCategories:id,name,parent_id,logo'])
                      ->find($category_id);
            $data['id']=$category->id;
            $data['title']=$category->name;
            $data['path']=$category->banner_path;

            $sub_category_data['label']="Categories By ".$category->name;
            $sub_category_data["horizontal"]=false;
            $sub_category_data["isCategory"]=true;
            $sub_category_data['type']=2;
            //if type==2 need data_field because Product List Contain category_id and brand_id based filter
            $sub_category_data['data_field']="category_id";
            $sub_category_data['data']=$category->subCategories
                ->map(fn($ele)=>(['id'=>$ele->id,'parent_id'=>$ele->parent_id,'name'=>$ele->name,'path'=>$ele->logo_path]));

            $brand_data["label"]="Brands By ".$category->name;
            $brand_data["horizontal"]=false;
            $brand_data['type']=2;
            //if type==2 need data_field because Product List Contain category_id and brand_id based filter
            $brand_data['data_field']="brand_id";
            $brand_data['data']=$category->brands;

            $category_data[]=$sub_category_data;
            $category_data[]=$brand_data;

            $data['data']=$category_data;
            return Responser::success('Category List', $data);
        } catch (Exception $e) {
            return Responser::failed($e->getMessage());
        }
    }
}
