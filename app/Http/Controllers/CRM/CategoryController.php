<?php

namespace App\Http\Controllers\CRM;

use App\Models\Category;
use App\Scopes\ActiveScope;
use Illuminate\Http\Request;
//use App\Models\RequestCategory;
use App\Http\Controllers\Controller;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;
use App\Http\Resources\Category as CategoryResource;
use Str;

class CategoryController extends Controller
{
    public function index()
    {
        $cat_menus = CategoryResource::collection(Category::withoutGlobalScope(ActiveScope::class)->whereNull('parent_id')->with(['getChildren.getChildren.getChildren.getChildren.getChildren.getChildren'])->get());

        return view('admin.pages.categories.index', compact('cat_menus'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.pages.categories.create');
    }

    public function store(Request $req)
    {
        $category = new Category;
        $category->parent_id = $req->parent_id;
        $category->category_name = $req->name;
        $category->slug = Str::slug($req->name, '-');
        $category->status = intval($req->status);
        if ($req->hasFile('image')) {
            $image = $req->file('image');
            $fileName   = uniqid() . '.' . $image->getClientOriginalExtension();
            $img = Image::make($image->getRealPath())->fit(641, 620);
            $img->stream();
            Storage::disk('local')->put('images/category/' . $fileName, $img);
            $category->image = $fileName;
        }
        $category->save();
        return redirect()->route('admin.categories.index');
    }

    public function update(Request $req, $id)
    {
        $category = Category::withoutGlobalScope(ActiveScope::class)->find($id);
        $category->parent_id = $req->parent_id;
        $category->category_name = $req->name;
        $category->slug = Str::slug($req->name, '-');
        if ($req->hasFile('image')) {
            if (!empty($category->image) && $category->image !== 'default-category.jpg') {
                $path = 'images/category/' . $category->image;
                if (Storage::disk('local')->exists($path)) {
                    Storage::disk('local')->delete($path);
                }
            }
            $image = $req->file('image');
            $fileName   = uniqid() . '.' . $image->getClientOriginalExtension();
            $img = Image::make($image->getRealPath());
            $img->fit(641, 620);
            $img->stream();
            Storage::disk('local')->put('images/category/' . $fileName, $img);
            $category->image = $fileName;
        }
        $category->status = intval($req->status);
        $category->save();
        return redirect()->route('admin.categories.index');
    }

    public function delete($id)
    {
        $category = Category::find($id);
        $category->delete();
        return redirect()->route('admin.categories.index');
    }
    public function status($id)
    {
        $category = Category::find($id);
        if ($category->status == 1) {
            $category->status = 0;
            $category->save();
        } else {
            $category->status = 1;
            $category->save();
        }

        return redirect()->route('admin.categories.index');
    }

    // public function requests()
    // {
    //     $categories = CategoryResource::collection(Category::withoutGlobalScope(ActiveScope::class)->whereNull('parent_id')->with(['getChildren.getChildren.getChildren.getChildren.getChildren.getChildren'])->get());
    //     //$requestCategories=RequestCategory::with('vendor:id,name,mobile_number,email')->get();

    //     //return $requestCategories;
    //     return view('admin.pages.categories.requests', compact('categories'));
    // }
    public function approve(Request $request)
    {
        $r_id = $request->request_id;
        $category = new Category;
        $category->parent_id = $request->parent_id;
        $category->name = $request->name;
        $category->status = intval($request->status);
        $category->save();
        $this->changeStatus($r_id, 1);
        //return $request;
        return redirect()->route('admin.categories.requests')->with(['status' => 'success', 'message' => 'Request approve and added to the categories']);
    }
    public function reject($id)
    {
        $this->changeStatus($id, 0);
        return redirect()->route('admin.categories.requests')->with(['status' => 'success', 'message' => 'Request rejected']);
    }
    private function changeStatus($id, $status)
    {
        $requestCategories = RequestCategory::find($id);
        $requestCategories->status = $status;
        $requestCategories->save();
    }
}
