<?php

namespace App\Http\Controllers\CRM;

use App\Models\Banner;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;
use Validator;
class BannerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $banners = Banner::get();
        return view('admin.pages.banners.index', compact('banners'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $formswap = "add";
        return view('admin.pages.banners.create', compact('formswap'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        $fileName   = uniqid() . '.' . $request->image->extension();
        $img = Image::make($request->image->getRealPath())->fit(1900, 870);
        $img->stream();
        Storage::disk('local')->put('images/banners/' . $fileName, $img);

        $banner = ["category_id" =>$request->category_id, "title" =>ucwords($request->title), "highligted_text" =>ucwords($request->highligted_text), "image" => $fileName] ;
        
        Banner::create($banner);

        return redirect()->route('admin.banners.index')->with(['status' => 'success', 'message' => 'New banner is addedd successfully']);
    }
    
    public function edit($id){
        $formswap = "edit";
        $banner = Banner::find($id);
        return view('admin.pages.banners.create', compact('formswap', 'banner'));
    }

    public function update(Request $request, $id){
        if($request->hasFile("image")){
            $path = 'images/banners/' . Banner::find($id)->image;
                if (Storage::disk('local')->exists($path)) {
                    Storage::disk('local')->delete($path);
                }
            $fileName   = uniqid() . '.' . $request->image->extension();
            $img = Image::make($request->image->getRealPath())->fit(1900, 870);
            $img->stream();
            Storage::disk('local')->put('images/banners/' . $fileName, $img);
            $banner = ["category_id" =>$request->category_id, "title" =>ucwords($request->title), "highligted_text" =>ucwords($request->highligted_text), "image" => $fileName] ;
        } 
        else{
            $banner = ["category_id" =>$request->category_id, "title" =>ucwords($request->title), "highligted_text" =>ucwords($request->highligted_text)] ;
        }

        Banner::where('id', $id)->update($banner);

        return redirect()->route('admin.banners.index')->with(['status' => 'success', 'message' => 'Banner is updated successfully']);
    }

    public function delete($id)
    {
        $path = 'images/banners/' . Banner::find($id)->image;
        if (Storage::disk('local')->exists($path)) {
            Storage::disk('local')->delete($path);
        }
        Banner::where('id', $id)->delete();

        return redirect()->route('admin.banners.index')->with(['status' => 'success', 'message' => 'Banner is deleted']);
    }
    public function status($id)
    {
        $banner = Banner::find($id);
        
        if($banner->status){
             $banner->status = 0;
             $message = "de-activated";
        }else{
             $banner->status = 1;
             $message = "re-activated";   
        }
        $banner->save();

        return redirect()->route('admin.banners.index')->with(['status' => 'success', 'message' => 'Banner status ' . $message]);
    }
}