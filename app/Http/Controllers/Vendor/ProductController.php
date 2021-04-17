<?php

namespace App\Http\Controllers\Vendor;

use Exception;
use App\Models\Brand;
use App\Models\Product;
use App\Models\Category;

use App\Models\ProductImage;
use Illuminate\Http\Request;
use App\Models\ProductVariant;
use App\Models\ProductVariants;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\Category as CategoryResource;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::select('id', 'vendor_id', 'category_id', 'brand_id', 'name', 'status')->with('category:id,parent_id,name', 'brand:id,name')->where('vendor_id', Auth::id())->get();
        return view('vendor.pages.products.index', compact('products'));
    }
    public function create()
    {
        $categories = CategoryResource::collection(Category::whereNull('parent_id')->with(['getChildren.getChildren.getChildren.getChildren.getChildren.getChildren'])->get());
        $brands = Brand::get();
        return view('vendor.pages.products.create', compact('categories', 'brands'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'category_id' => 'required|exists:categories,id',
            'brand_id' => 'required|exists:brands,id',
            'name' => 'required|min:1',
            'actual_price' => 'required',
            'discount' => 'required|min:0|max:100',
            'fixed_price' => 'required|lte:actual_price',
            'highlight' => 'required',
            'specification' => 'required',
            'available_size' => 'required',
            'available_color' => 'required',
            'variants' => 'required',
            'media' => 'array|min:1',
            'media_crop' => 'required'
        ]);
        if ($validator->fails()) {
            return response()->json(['status' => false, 'errors' => $validator->errors()]);
        }
        try {
            //json_decode($json:string,assoc:boolean) assoc: parameter for want return value as array
            $highlight = json_decode($request->highlight, true);
            $specification = json_decode($request->specification, true);
            $available_color = json_decode($request->available_color, true);
            $available_size = json_decode($request->available_size, true);

            $product = new Product;
            $product->vendor_id = $request->user()->id;
            $product->category_id = $request->category_id;
            $product->brand_id = $request->brand_id;
            $product->name = $request->name;
            $product->actual_price = $request->actual_price;
            $product->discount = $request->discount;
            $product->fixed_price = $request->fixed_price;
            $product->description = $request->description;
            $product->detailed_description = $request->detailed_description;
            $product->highlight = $highlight;
            $product->specification = $specification;
            $product->available_color = $available_color;
            $product->available_size = $available_size;
            $product->save();
            $product->categories()->sync($product->parents_path->pluck('id'));

            $variants = json_decode($request->variants, true);
            foreach ($variants as $variant) {
                $productVariant = new ProductVariant;
                $productVariant->product_id = $product->id;
                $productVariant->size = $variant["size"];
                $productVariant->color = $variant["color"]["code"] . "||" . $variant["color"]["name"];
                $productVariant->quantity = $variant['quantity'];
                $productVariant->save();
            }
            $media_crop = json_decode($request->media_crop, true);
            $media = $request->media;


            for ($i = 0; $i < count($media); $i++) {
                if (!$request->hasFile('media.' . $i)) {
                    continue;   //if files is not valid to store.it will skip the current index of this loop
                }
                $file = $request->file('media.' . $i);
                $type = $file->getClientMimeType();
                $fileName   = uniqid() . '.' . $file->getClientOriginalExtension();
                if (explode('/', $type)[0] == 'image') {
                    $res = Image::make($file);
                    if (isset($media_crop[$i]) && !empty($media_crop[$i])) {
                        extract($media_crop[$i]);
                        if (isset($rotation) && !empty($rotation)) {
                            $res->rotate(-$rotation);
                        }
                        $res->crop(intVal($width), intVal($height), intVal($left), intVal($top));
                    }
                    $res->stream();
                    Storage::disk('local')->put('images/products/' . $fileName, $res);
                } else {
                    $res = $file;
                    Storage::disk('local')->putFileAs('images/products/', $res, $fileName);
                }
                $productMedia = new ProductImage;
                $productMedia->product_id = $product->id;
                $productMedia->type = $type;
                $productMedia->name = $fileName;
                $productMedia->save();
            }
            return response()->json(['status' => true, 'message' => 'Product added successfully']);
        } catch (Exception $th) {
            return response()->json(['status' => false, 'message' => $th->getMessage()]);
        }
    }

    public function show(Product $product)
    {
        //return $product->productMedia;
        return view('vendor.pages.products.show', compact('product'));
    }

    public function edit(Product $product)
    {
        $categories = CategoryResource::collection(Category::whereNull('parent_id')->with(['getChildren.getChildren.getChildren.getChildren.getChildren.getChildren'])->get());
        $brands = Brand::get();
        $preload_media = [];
        foreach ($product->productMedia as $key => $media) {
            $preload_media[] = array(
                "name" => $media->name,
                "type" => $media->type,
                "size" => Storage::disk('local')->size('images/products/' . $media->name),
                "file" => $media->path,
                "data" => array(
                    "url" => pathinfo($media->path),
                    "readerCrossOrigin" => 'anonymous',
                    "popup" => true,
                ),
            );
        }
        $product['preload_media'] = json_encode($preload_media);
        //return $product->preload_media;
        //return compact('product', 'categories', 'brands');
        return view('vendor.pages.products.edit', compact('product', 'categories', 'brands'));
    }

    public function update(Request $request, Product $product)
    {
        $validator = Validator::make($request->all(), [
            'category_id' => 'required|exists:categories,id',
            'brand_id' => 'required|exists:brands,id',
            'name' => 'required|min:1',
            'actual_price' => 'required',
            'discount' => 'required|min:0|max:100',
            'fixed_price' => 'required|lte:actual_price',
            'highlight' => 'required',
            'specification' => 'required',
            'available_size' => 'required',
            'available_color' => 'required',
            'variants' => 'required',
            'media' => 'array|min:1',
            'media_crop' => 'required'
        ]);
        if ($validator->fails()) {
            return response()->json(['status' => false, 'errors' => $validator->errors()]);
        }
        try {
            //json_decode($json:string,assoc:boolean) assoc: parameter for want return value as array
            $highlight = json_decode($request->highlight, true);
            $specification = json_decode($request->specification, true);
            $available_color = json_decode($request->available_color, true);
            $available_size = json_decode($request->available_size, true);

            $product->vendor_id = $request->user()->id;
            $product->category_id = $request->category_id;
            $product->brand_id = $request->brand_id;
            $product->name = $request->name;
            $product->actual_price = $request->actual_price;
            $product->discount = $request->discount;
            $product->fixed_price = $request->fixed_price;
            $product->description = $request->description;
            $product->detailed_description = $request->detailed_description;
            $product->highlight = $highlight;
            $product->specification = $specification;
            $product->available_color = $available_color;
            $product->available_size = $available_size;
            $product->update();
            $product->categories()->sync($product->parents_path->pluck('id'));

            $variants = json_decode($request->variants, true);
            $product->variants()->delete();
            foreach ($variants as $variant) {
                $productVariant = new ProductVariants;
                $productVariant->product_id = $product->id;
                $productVariant->size = $variant["size"];
                $productVariant->color = $variant["color"]["code"] . "||" . $variant["color"]["name"];
                $productVariant->quantity = $variant['quantity'];
                $productVariant->save();
            }
            $media_crop = json_decode($request->media_crop, true);
            $media = collect($request->media);
            $previous_media = collect($product->productMedia);
            $media_url = $media->filter(fn ($ele) => is_string($ele))->map(fn ($ele) => basename($ele));
            $need_to_trash = $previous_media->filter(fn ($ele) => !($media_url->contains($ele->name)))->map(fn ($ele) => "images/products/" . $ele->name);
            $product->productMedia()->whereNotIn('name', $media_url)->delete();

            try {
                if (!$need_to_trash->isEmpty()) {
                    Storage::disk('local')->delete($need_to_trash->toArray());
                }
            } catch (Exception $e) {
                return response()->json(['status' => false, 'message' => $e->getMessage()]);
            }
            for ($i = 0; $i < count($media); $i++) {
                if (is_string($media[$i])) {
                    continue;
                }
                if (!$request->hasFile('media.' . $i)) {
                    continue;   //if files is not valid to store.it will skip the current index of this loop
                }
                $file = $request->file('media.' . $i);
                $type = $file->getClientMimeType();
                $fileName   = uniqid() . '.' . $file->getClientOriginalExtension();
                if (explode('/', $type)[0] == 'image') {
                    $res = Image::make($file);
                    if (isset($media_crop[$i]) && !empty($media_crop[$i])) {
                        extract($media_crop[$i]);
                        if (isset($rotation) && !empty($rotation)) {
                            $res->rotate(-$rotation);
                        }
                        $res->crop(intVal($width), intVal($height), intVal($left), intVal($top));
                    }
                    $res->stream();
                    Storage::disk('local')->put('images/products/' . $fileName, $res);
                } else {
                    $res = $file;
                    Storage::disk('local')->putFileAs('images/products/', $res, $fileName);
                }
                $productMedia = new ProductImage;
                $productMedia->product_id = $product->id;
                $productMedia->type = $type;
                $productMedia->name = $fileName;
                $productMedia->save();
            }
            return response()->json(['status' => true, 'message' => 'Product Edited successfully']);
        } catch (Exception $e) {
            return response()->json(['status' => false, 'message' => $e->getMessage()]);
        }
    }

    public function destroy(Product $product)
    {
        //
    }
    public function status(Product $product)
    {
        $product->status = !$product->status;
        $product->save();
        if ($product->status) {
            return redirect()->route('vendor.products.index')->with(['status' => 'success', 'message' => 'Product activated']);
        } else {
            return redirect()->route('vendor.products.index')->with(['status' => 'success', 'message' => 'Product deactivated']);
        }
    }
}
