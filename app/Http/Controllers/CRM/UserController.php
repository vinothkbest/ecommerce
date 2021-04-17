<?php

namespace App\Http\Controllers\CRM;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;
use App\Models\Address;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users=User::get();
        return view('admin.pages.users.index', ['users'=>$users]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.pages.users.create');
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
            'mobile_number'=>'required|min:8|max:15|unique:users,mobile_number',
            'contact_number'=>'nullable|min:8|max:15',
            'gst_number'=>[Rule::requiredIf(fn () =>$req->hasFile('gst_document')),'nullable','alpha_num','size:15','unique:users,gst_number'],
            'email'=>'required|email|unique:users,email',
            'shop_name'=>'required|min:3|max:30',
            'address'=>'required|min:15|max:100',
            'status'=>'required',
            'profile_image'=>'nullable|image|mimes:jpeg,png,jpg,gif|dimensions:max_width=1024,max_height=1024,ratio=1/1',
            'gst_document'=>[Rule::requiredIf(fn () =>$req->gst_number!=''),'nullable','image','mimes:jpeg,png,jpg,gif']
        ]);
        $user_data=$req->only(['name','mobile_number','contact_number','email','shop_name','address','status']);

        if ($req->gst_document!==null && $req->gst_number) {
            if ($req->hasFile('gst_document')) {
                $file=$req->file('gst_document');
                $fileName   = uniqid() . '.' . $file->getClientOriginalExtension();
                $img = Image::make($file->getRealPath());
                $img->stream();
                Storage::disk('local')->put('images/documents/'.$fileName, $img);
                $user_data['gst_number']=$req->gst_number;
                $user_data['gst_document']=$fileName;
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
            $user_data['profile_image']=$fileName;
        }
        $user_data['gst_verified_at']=Carbon::now();
        $user_data['otp_verified_at']=Carbon::now();
        $user_data['email_verified_at']=Carbon::now();

        User::create($user_data);
        return redirect()->route('admin.users.index')->with(['status' => 'success', 'message' => 'user created successfully']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {   
        $addresses = Address::where('user_id', $user->id)->orderByDesc('is_default')->get();
        return view('admin.pages.users.detail', compact('addresses'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        return view('admin.pages.users.edit', ['user'=>$user]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $req, User $user)
    {
        $this->validate($req, [
            'name'=>'required',
            'contact_number'=>'nullable|min:8|max:15',
            'gst_number'=>'nullable|alpha_num|size:15|unique:users,gst_number,'.$user->id,
            'email'=>'required|email|unique:users,email,'.$user->id,
            'shop_name'=>'required|min:3|max:30',
            'address'=>'required|min:15|max:100',
            'status'=>'required',
            'profile_image'=>'nullable|image|mimes:jpeg,png,jpg,gif|dimensions:max_width=1024,max_height=1024,ratio=1/1',
            'gst_document'=>'nullable|image|mimes:jpeg,png,jpg,gif'
        ]);
        $user_data=$req->only(['name','contact_number','email','shop_name','gst_number','address','status']);

        if ($req->gst_document!==null && $req->hasFile('gst_document')) {
            if ($user->gst_document) {
                // if (Storage::disk('local')->has('images/profiles/'.$user->profile_image) && !Storage::disk('local')->has('trash/profiles/'.$user->profile_image)) {}
                try {
                    Storage::disk('local')->move('images/documents/'.$user->profile_image, 'trash/document/'.$user->profile_image);
                } catch (\Exception $e) {
                    Log::info($e->getMessage());
                }
            }

            $file=$req->file('gst_document');
            $fileName   = uniqid() . '.' . $file->getClientOriginalExtension();
            $img = Image::make($file->getRealPath());
            $img->stream();
            Storage::disk('local')->put('images/documents/'.$fileName, $img);
            $user_data['gst_verified_at']=Carbon::now();
            $user_data['gst_document']=$fileName;
        }

        if ($req->hasFile('profile_image')) {
            if ($user->profile_image && $user->profile_image!=='default-profile.jpg') {
                // if (Storage::disk('local')->has('images/profiles/'.$user->profile_image) && !Storage::disk('local')->has('trash/profiles/'.$user->profile_image)) {}
                try {
                    Storage::disk('local')->move('images/profiles/'.$user->profile_image, 'trash/profiles/'.$user->profile_image);
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
            $user_data['profile_image']=$fileName;
        }

        $user->update($user_data);
        return redirect()->route('admin.users.index')->with(['status' => 'success', 'message' =>'User '. $user->name.' updated successfully']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
    }
    public function status(User $user)
    {
        $user->status=!$user->status;
        $user->save();
        if ($user->status) {
            return redirect()->route('admin.users.index')->with(['status'=>'success','message'=>$user->name.' user was activated']);
        } else {
            return redirect()->route('admin.users.index')->with(['status'=>'error','message'=>$user->name.' user was disabled']);
        }
    }
    public function verify(User $user)
    {
        $user->gst_verified_at=$user->gst_verified_at?null:Carbon::now();
        $user->save();
        if ($user->gst_verified_at) {
            return redirect()->route('admin.users.index')->with(['status'=>'success','message'=>$user->name.' user was Verified']);
        } else {
            return redirect()->route('admin.users.index')->with(['status'=>'error','message'=>$user->name.' user was Unverified']);
        }
    }
}
