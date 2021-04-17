<?php

namespace App\Http\Controllers\CRM;

use App\Models\Brand;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;
use App\Models\Product;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $brands = Brand::orderByDesc("created_at")->get();
        //return $brands;
        return view('admin.pages.brands.index')->with(['brands' => $brands]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.pages.brands.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|unique:brands,brand_name',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif',
        ],[
            "name.unique" => "This brand is already used"
        ]);

        $brand = new Brand;
        if ($request->hasFile('image')) {

            $image = $request->file('image');
            $fileName   = uniqid() . '.' . $image->getClientOriginalExtension();
            $img = Image::make($image->getRealPath());
            $img->resize(256, 256, function ($constraint) {
                $constraint->aspectRatio();
            });

            $img->stream();
            Storage::disk('local')->put('images/brands/' . $fileName, $img);
            $brand->brand_image = $fileName;
        }

        $brand_name = strtolower($request->name);
        $slug = preg_replace('/\s+/', '', $brand_name);
        $slug_name = $slug . '-' . uniqid();
        $brand->brand_name = $request->name;
        $brand->slug = $slug_name;
        $brand->save();
        $brand->categories()->sync($request->categories);        
        
        return redirect()->route('admin.brands.index')->with(['status' => 'success', 'message' => 'Brand created successfully']);
    }

    public function edit(Brand $brand)
    {

        //return $brand;
        // $categories = Category::select('id', 'category_name')->whereNull('parent_id')->get();

        return view('admin.pages.brands.edit', compact('brand'));
    }

    public function update(Request $request, Brand $brand)
    {
        $this->validate($request, [
            'name' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg,gif',
        ],[
            "name.unique" => "This brand is already used",
            "image.image" => "Image file only required",
        ]);

        if ($request->hasFile('image')) {
            if ($brand->image && $brand->image !== 'default-brand.jpg') {
                try {
                    Storage::disk('local')->delete('images/brands/' . $brand->image);
                } catch (\Exception $e) {
                    Log::info($e->getMessage());
                }
            }
            $image = $request->file('image');
            $fileName   = uniqid() . '.' . $image->getClientOriginalExtension();
            $img = Image::make($image->getRealPath());
            $img->resize(256, 256, function ($constraint) {
                $constraint->aspectRatio();
            });

            $img->stream();
            Storage::disk('local')->put('images/brands/' . $fileName, $img);
            $brand->brand_image = $fileName;
        }
        
        $brand->brand_name = $request->name;
        $brand->categories()->sync($request->categories);
        $brand->save();

        return redirect()->route('admin.brands.index')->with(['status' => 'success', 'message' => 'Brand updated successfully']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function delete($brand)
    {
        $brand = Brand::find($brand);

        if(Product::where('brand_id', $brand)->first() || count($brand->categories) != 0){
        
            return redirect()->route('admin.brands.index')->with(['status' => 'error', 'message' => 'Brand has category or products!']);
        }
        
        else{
            $brand->delete();

        return redirect()->route('admin.brands.index')->with(['status' => 'success', 'message' => 'Brand deleted successfully']);
        }
    }
    public function status(Brand $brand)
    {
        $brand->status = !$brand->status;
        $brand->save();
        if ($brand->status) {
            return redirect()->route('admin.brands.index')->with(['status' => 'success', 'message' => 'Brand activated']);
        } else {
            return redirect()->route('admin.brands.index')->with(['status' => 'success', 'message' => 'Brand deactivated']);
        }
    }
}
