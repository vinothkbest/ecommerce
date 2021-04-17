<?php

namespace App\Http\Controllers\Vendor;

use App\Models\Vendor;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;

class VendorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $vendors=Vendor::get();
        return view('vendor.pages.vendors.index', ['vendors'=>$vendors]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('vendor.pages.vendors.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $req)
    {
        $this->validate($req, [
            'name'=>'required',
            'mobile_number'=>'required|min:8|max:15|unique:vendors,mobile_number',
            'contact_number'=>'nullable|min:8|max:15',
            'gst_number'=>[Rule::requiredIf(fn () =>$req->hasFile('gst_document')),'nullable','alpha_num','size:15','unique:vendors,gst_number'],
            'email'=>'required|email|unique:vendors,email',
            'shop_name'=>'required|min:3|max:30',
            'address'=>'required|min:15|max:100',
            'status'=>'required',
            'profile_image'=>'nullable|image|mimes:jpeg,png,jpg,gif|dimensions:max_width=1024,max_height=1024,ratio=1/1',
            'gst_document'=>[Rule::requiredIf(fn () =>$req->gst_number!=''),'nullable','image','mimes:jpeg,png,jpg,gif']
        ]);
        $vendor_data=$req->only(['name','mobile_number','contact_number','email','shop_name','address','status']);

        if ($req->gst_document!==null && $req->gst_number) {
            if ($req->hasFile('gst_document')) {
                $file=$req->file('gst_document');
                $fileName   = uniqid() . '.' . $file->getClientOriginalExtension();
                $img = Image::make($file->getRealPath());
                $img->stream();
                Storage::disk('local')->put('images/documents/'.$fileName, $img);
                $vendor_data['gst_number']=$req->gst_number;
                $vendor_data['gst_document']=$fileName;
            }
        }
        if ($req->hasFile('profile_image')) {
            $image=$req->file('profile_image');
            $fileName   = uniqid() . '.' . $image->getClientOriginalExtension();
            $img = Image::make($image->getRealPath());
            $img->resize(256, 256, function ($constraint) {
                $constraint->aspectRatio();
            });

            $img->stream();
            Storage::disk('local')->put('images/profiles/'.$fileName, $img);
            $vendor_data['profile_image']=$fileName;
        }
        $vendor_data['gst_verified_at']=Carbon::now();
        $vendor_data['otp_verified_at']=Carbon::now();
        $vendor_data['email_verified_at']=Carbon::now();

        Vendor::create($vendor_data);
        return redirect()->route('vendor.vendors.index')->with(['status' => 'success', 'message' => 'Vendor created successfully']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Vendor  $vendor
     * @return \Illuminate\Http\Response
     */
    public function show(Vendor $vendor)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Vendor  $vendor
     * @return \Illuminate\Http\Response
     */
    public function edit(Vendor $vendor)
    {
        return view('vendor.pages.vendors.edit', ['vendor'=>$vendor]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Vendor  $vendor
     * @return \Illuminate\Http\Response
     */
    public function update(Request $req, Vendor $vendor)
    {
        $this->validate($req, [
            'name'=>'required',
            'contact_number'=>'nullable|min:8|max:15',
            'gst_number'=>'nullable|alpha_num|size:15|unique:vendors,gst_number,'.$vendor->id,
            'email'=>'required|email|unique:vendors,email,'.$vendor->id,
            'shop_name'=>'required|min:3|max:30',
            'address'=>'required|min:15|max:100',
            'status'=>'required',
            'profile_image'=>'nullable|image|mimes:jpeg,png,jpg,gif|dimensions:max_width=1024,max_height=1024,ratio=1/1',
            'gst_document'=>'nullable|image|mimes:jpeg,png,jpg,gif'
        ]);
        $vendor_data=$req->only(['name','contact_number','email','shop_name','gst_number','address','status']);

        if ($req->gst_document!==null && $req->hasFile('gst_document')) {
            if ($vendor->gst_document) {
                // if (Storage::disk('local')->has('images/profiles/'.$vendor->profile_image) && !Storage::disk('local')->has('trash/profiles/'.$vendor->profile_image)) {}
                try {
                    Storage::disk('local')->move('images/documents/'.$vendor->profile_image, 'trash/document/'.$vendor->profile_image);
                } catch (\Exception $e) {
                    Log::info($e->getMessage());
                }
            }

            $file=$req->file('gst_document');
            $fileName   = uniqid() . '.' . $file->getClientOriginalExtension();
            $img = Image::make($file->getRealPath());
            $img->stream();
            Storage::disk('local')->put('images/documents/'.$fileName, $img);
            $vendor_data['gst_verified_at']=Carbon::now();
            $vendor_data['gst_document']=$fileName;
        }

        if ($req->hasFile('profile_image')) {
            if ($vendor->profile_image && $vendor->profile_image!=='default-profile.jpg') {
                // if (Storage::disk('local')->has('images/profiles/'.$vendor->profile_image) && !Storage::disk('local')->has('trash/profiles/'.$vendor->profile_image)) {}
                try {
                    Storage::disk('local')->move('images/profiles/'.$vendor->profile_image, 'trash/profiles/'.$vendor->profile_image);
                } catch (\Exception $e) {
                    Log::info($e->getMessage());
                }
            }

            $image=$req->file('profile_image');
            $fileName   = uniqid() . '.' . $image->getClientOriginalExtension();
            $img = Image::make($image->getRealPath());
            $img->resize(256, 256, function ($constraint) {
                $constraint->aspectRatio();
            });

            $img->stream();
            Storage::disk('local')->put('images/profiles/'.$fileName, $img);
            $vendor_data['profile_image']=$fileName;
        }

        $vendor->update($vendor_data);
        return redirect()->route('vendor.vendors.index')->with(['status' => 'success', 'message' =>'Vendor '. $vendor->name.' updated successfully']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Vendor  $vendor
     * @return \Illuminate\Http\Response
     */
    public function destroy(Vendor $vendor)
    {
        //
    }
    public function status(Vendor $vendor)
    {
        $vendor->status=!$vendor->status;
        $vendor->save();
        if ($vendor->status) {
            return redirect()->route('vendor.vendors.index')->with(['status'=>'success','message'=>$vendor->name.' vendor was activated']);
        } else {
            return redirect()->route('vendor.vendors.index')->with(['status'=>'error','message'=>$vendor->name.' vendor was disabled']);
        }
    }
    public function verify(Vendor $vendor)
    {
        $vendor->gst_verified_at=$vendor->gst_verified_at?null:Carbon::now();
        $vendor->save();
        if ($vendor->gst_verified_at) {
            return redirect()->route('vendor.vendors.index')->with(['status'=>'success','message'=>$vendor->name.' vendor was Verified']);
        } else {
            return redirect()->route('vendor.vendors.index')->with(['status'=>'error','message'=>$vendor->name.' vendor was Unverified']);
        }
    }
}
