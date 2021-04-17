<?php

namespace App\Http\Controllers\CRM;

use Exception;
use Carbon\Carbon;
use App\Models\Unit;
use App\Models\Brand;
use App\Models\Vendor;
use App\Models\Product;
use App\Models\Category;
use Faker\Provider\File;
use App\Models\ProductImage;
use Illuminate\Http\Request;
use App\Models\ProductVariant;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\Cache\Store;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\Category as CategoryResource;
use App\Models\SeoList;
use App\Helper\BlogClass;
use Str;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with('categories')->orderByDesc('updated_at')->get();
        //return $products;
        return view('admin.pages.products.index', compact('products'));
    }
    public function create()
    {
        $categories = CategoryResource::collection(Category::whereNull('parent_id')->with(['getChildren.getChildren.getChildren'])->get());
        
        $units = Unit::get();
        $brands = Brand::get();
        return view('admin.pages.products.create', compact('categories', 'brands', 'units'));
    }

    public function store(Request $request)
    {
        $product = new Product();
        $product->product_name = ucfirst($request->product_name);
        $product->brand_id = $request->brand;
        $product->description = $request->product_description;
        $product->detailed_description = $request->detailed_description;
        $product->slug = Str::slug($request->product_name,'-').random_int(-9999, -1000);
        $product->gst_tax = $request->gst_tax;
        $product->save();
        
        if(!empty($request->child_sub_category_id)){
            $categories = [intval($request->category_id), intval($request->sub_category_id), intval($request->child_sub_category_id)];
        }
        elseif(!empty($request->sub_category_id) && empty($request->child_sub_category_id)){
            $categories = [intval($request->category_id), intval($request->sub_category_id)];
        }
        elseif(!empty($request->category_id) && empty($request->sub_category_id)){
            $categories = [intval($request->category_id)];
        }
        $product->categories()->sync($categories);

        $product_variants = collect($request->variants)->values();
        foreach ($product_variants as $variant) {

            $product_variant = new ProductVariant();
            $product_variant->product_id = $product->id;
            $product_variant->unit_id = $variant['unit_id'];
            $product_variant->variant_name = $variant['variant_name'];
            $product_variant->actual_price = $variant['actual_price'];
            $product_variant->discount_price = $variant['discount_price'];
            $product_variant->selling_price = ($variant['actual_price']-$variant['discount_price']);
            $product_variant->available_quantity_count = $variant['availability_count'];
            $product_variant->save();
        }
        
        if ($files = $request->file('images')) {
            foreach ($files as $index => $file) {

                $product_image = new ProductImage();
                $product_image->product_id = $product->id;
                $image = uniqid() . '.' . $file->getClientOriginalExtension();
                $img = Image::make($file->getRealPath());
                $img->resize(256, 256, function ($constraint) {
                    $constraint->aspectRatio();
                });
                $img->stream();
                Storage::disk('local')->put('images/product_images/' . $image, $img);

                $product_image->image = $image;
                $product_image->save();
            }
        }

        //Add Seo Contents

        $seo = new SeoList;
        BlogClass::seo($seo, $request, 'images/seo', $request->file('seo-image'));
        $product = Product::find($product->id);
        $product->productSeo()->save($seo);

        return redirect()->route('admin.products.index')->with(['status' => 'success', 'message' => 'Product & its seo are created successfully']);
    }

    public function show(Product $product)
    {
        //return $product->productMedia;
        return view('admin.pages.products.detail', compact('product'));
    }

    public function edit(Product $product)
    {
        $categories = CategoryResource::collection(Category::whereNull('parent_id')->with(['getChildren.getChildren.getChildren'])->get());

        $brands = Brand::get();
        $units = Unit::get();
         return view('admin.pages.products.edit', compact('categories', 'product', 'brands', 'units'));
    }

    public function update(Request $request, Product $product)
    {
        $product->product_name = ucfirst($request->product_name);
        $product->brand_id = $request->brand;
        $product->description = $request->product_description;
        $product->detailed_description = $request->detailed_description;
        $product->gst_tax = $request->gst_tax;
        $product->save();
        
        if(!empty($request->child_sub_category_id)){
            $categories = [intval($request->category_id), intval($request->sub_category_id), intval($request->child_sub_category_id)];
        }
        elseif(!empty($request->sub_category_id) && empty($request->child_sub_category_id)){
            $categories = [intval($request->category_id), intval($request->sub_category_id)];
        }
        elseif(!empty($request->category_id) && empty($request->sub_category_id)){
            $categories = [intval($request->category_id)];
        }
        $product->categories()->sync($categories);

        $product_variants = collect($request->variants)->values();
        if(!empty($request->remove_variants)){

        ProductVariant::whereIn('id', $request->remove_variants)->where('product_id', $product->id)->delete(); 
        }
        foreach ($product_variants as $variant) {

            if (isset($variant['product_variant_id'])) {
                $product_variant = ProductVariant::find($variant['product_variant_id']);
            } else {
                $product_variant = new ProductVariant();
            }
            $product_variant->product_id = $product->id;
            $product_variant->unit_id = $variant['unit_id'];
            $product_variant->variant_name = $variant['variant_name'];
            $product_variant->actual_price = $variant['actual_price'];
            $product_variant->discount_price = $variant['discount_price'];
            $product_variant->selling_price = ($variant['actual_price']-$variant['discount_price']);
            $product_variant->available_quantity_count = $variant['availability_count'];
            $product_variant->save();
        }
        if ($files = $request->file('images')) {

            $product_images = ProductImage::where('product_id', $product->id);
            foreach ($product_images->get() as $images) {
                    $path='images/product_images/'.$images->image;
                    if (Storage::disk('local')->exists($path)) {
                        Storage::disk('local')->delete($path);
                    }
            }
            $product_images->delete();

            foreach ($files as $index => $file) {

                $product_image = new ProductImage;
                
                $product_image->product_id = $product->id;
                $image = uniqid() . '.' . $file->getClientOriginalExtension();
                $img = Image::make($file->getRealPath());
                $img->resize(256, 256, function ($constraint) {
                    $constraint->aspectRatio();
                });
                $img->stream();
                Storage::disk('local')->put('images/product_images/' . $image, $img);

                $product_image->image = $image;
                $product_image->save();
            }
        }

        //Add Seo Contents

        $seo = SeoList::where(['contentable_id'=> $product->id, 'contentable_type'=>'product'])->first();
        
        if ($request->hasFile('seo-image')) {
            $path='images/seo/'.$seo->image;
            if (Storage::disk('local')->exists($path)) {
                Storage::disk('local')->delete($path);
            }
        }

        BlogClass::seo($seo, $request, 'images/seo', $request->file('seo-image'));
        $product = Product::find($product->id);
        $product->productSeo()->save($seo);

        return redirect()->route('admin.products.index')->with(['status' => 'success', 'message' => $product->product_name . ' & its seo are updated successfully']);
    }

    public function status(Product $product)
    {
        $product->status = !$product->status;
        $product->save();
        if ($product->status) {
            return redirect()->route('admin.products.index')->with(['status' => 'success', 'message' => 'Product activated']);
        } else {
            return redirect()->route('admin.products.index')->with(['status' => 'success', 'message' => 'Product deactivated']);
        }
    }

    public function delete(Product $product){
        //seo content delete
        $seo = SeoList::where(['contentable_id'=> $product->id, 'contentable_type' => 'product'])->first();
        if($seo){
            if($seo->image != NULL){
                $path='images/seo/'.$seo->image;
                if (Storage::disk('local')->exists($path)) {
                    Storage::disk('local')->delete($path);
                }
            }
            
            $seo->delete();
        }
        //product images delete
        $product_images = ProductImage::where('product_id', $product->id);

        foreach ($product_images->get() as $images) {
                $path='images/product_images/'.$images->image;
                if (Storage::disk('local')->exists($path)) {
                    Storage::disk('local')->delete($path);
                }
        }
        $product_images->delete();
        //product images delete
        ProductVariant::where('product_id', $product->id)->delete();
        //categories delete in pivot
        $product->categories()->detach();
        //delete product
        $product->delete();

        return redirect()->route('admin.products.index')->with(['status' => 'success', 'message' => 'Product has been removed successfully']);

    }
}
