<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use App\Http\Resources\Category as CategoryResource;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories=CategoryResource::collection(Category::whereNull('parent_id')->whereNotIn('status', [0])->with(['getChildren.getChildren.getChildren.getChildren.getChildren.getChildren'=>function ($query) {
            return $query->whereNotIn('status', [0]);
        }])->get());
        //return $categories;
        return view('vendor.pages.categories.index')->with(['categories'=>$categories]);
    }

    public function store(Request $req)
    {
        $this->validate($req, [
            'name'=>'required||min:1'
        ]);
        //  return $req;
        $category=new Category;
        $category->parent_id=$req->parent_id;
        $category->name=$req->name;
        $category->status=2;
        $category->save();
        return redirect()->route('vendor.categories.index')->with(['status'=>'success','message'=>'Category Requested Successfully']);
        ;
    }
}
