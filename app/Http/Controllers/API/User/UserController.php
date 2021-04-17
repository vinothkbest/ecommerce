<?php

namespace App\Http\Controllers\API\User;

use Responser;
use Sms;
use App\Models\User;
use App\Models\StaticPage;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Http\Controllers\Controller;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    //Response handlers

    private function throwFailedMessage($message, $code=200)
    {
        return Responser::failed($message, [], $code);
    }

    private function throwSuccessMessage($message, $data=[], $code=200)
    {
        return Responser::success($message, $data, $code);
    }
    //SMS handler
    private function getOTP($number, $hash='')
    {
        $otp=mt_rand(1000, 9999);
        $isSmsSend=Sms::otp($number, $otp, $hash);

        return $isSmsSend? $otp: $isSmsSend;
    }
    public function loginUser(Request $req)
    {
        $validatedData =  Validator::make($req->all(), [
            'mobile_number' => 'required|max:15|min:8',
        ]);

        if ($validatedData->fails()) {
            return $this->throwFailedMessage($validatedData->errors()->first());
        }
        $mobile_number = $req->mobile_number;            //store mobile Number

        $user=User::where('mobile_number', $mobile_number)->first();

        if (!$user) {
            $user= new User();
            $user->mobile_number=$mobile_number;
            $user->status=2;
        }

        $otp=$this->getOTP($mobile_number);
        if (!$otp) {
            return $this->throwFailedMessage("Could Not Send SMS! Please try again later..");
        }

        $user->otp=$otp;
        $user->save();
        $res=[
            "user_id"=>$user->id,
            "$mobile_number"=>$user->mobile_number,
            "otp"=>$user->otp,
            "status"=>$user->status
        ];
        return $this->throwSuccessMessage("OTP send successfully", $res);
    }
    public function resendOTP(Request $req)
    {
        $validatedData =  Validator::make($req->all(), [
            'user_id'=>'required|exists:users,id'
        ]);

        if ($validatedData->fails()) {
            return $this->throwFailedMessage($validatedData->errors()->first());
        }
        $user_id=$req->user_id;
        $user=User::find($user_id);
        $otp=$this->getOTP($user->mobile_number);
        if (empty($otp)) {
            return $this->throwFailedMessage("Could Not Send SMS! Please try again later..");
        }

        $user->otp=$otp;
        $user->save();
        $res=[
            "user_id"=>$user->id,
            "mobile_number"=>$user->mobile_number,
            "otp"=>$user->otp,
            "status"=>$user->status
        ];
        return $this->throwSuccessMessage("OTP resend successfully", $res);
    }

    public function verifyOTP(Request $req)
    {
        $validatedData =  Validator::make($req->all(), [
            'otp' => 'required|digits:4',
            'user_id'=>'required|exists:users,id'
        ]);

        if ($validatedData->fails()) {
            return $this->throwFailedMessage($validatedData->errors()->first());
        }
        $user_id=$req->user_id;
        $otp=$req->otp;

        $user=User::find($user_id);
        if (!$user->otp && $user->otp=="") {
            return $this->throwFailedMessage('OTP was Expired.Please click resend OTP or login again to continue.');
        } elseif ($user->otp==$otp) {
            $user->tokens()->delete();
            $token = $user->createToken('yr-$12thxz98');
            $user->otp=null;
            $user->otp_verified_at=Carbon::now();
            $user->save();
            return $this->throwSuccessMessage("OTP Verified Succesfully", ["user"=>$user,"token"=>$token->plainTextToken]);
        } else {
            return $this->throwFailedMessage("Please Check your OTP");
        }
    }

    public function verifyToken(Request $request)
    {
        $user=$request->user();
        $data['user']=$user;
        $data['isTokenValid']=true;
        $data['message']="Token Verified";
        return $this->throwSuccessMessage('Token Verified Successfully', $data);
    }

    public function updateUser(Request $req)
    {
        $user=$req->user();
        $user_id=$user->id;
        $validatedData =  Validator::make($req->all(), [
            'email'=>'email|unique:users,email,'.$user_id,
            'gst_number'=>'required|alpha_num|size:15|unique:users,gst_number,'.$user_id,
            'profile_image'=>'image|mimes:jpeg,png,jpg,gif|dimensions:max_width=1024,max_height=1024,ratio=1/1',
            'gst_document'=>'nullable|image|mimes:jpeg,png,jpg,gif'
        ], [
            "profile_image.dimensions"=>"ProfileImage Ratio must 1:1 ratio and width & height within 1024px"
        ]);

        if ($validatedData->fails()) {
            return $this->throwFailedMessage($validatedData->errors()->first());
        }

        if ($user->otp_verified_at===null) {
            return $this->throwFailedMessage("Look like unauthorized user.Plase login to continue", 401);
        }
        if ($user->gst_verified_at===null) {
            $user->gst_number=$req->gst_number;
            if ($req->hasFile('gst_document')) {
                $file=$req->file('gst_document');
                if (!empty($user->gst_document)) {
                    $path = 'images/documents/'.$user->gst_document;
                    if (Storage::disk('local')->exists($path)) {
                        Storage::disk('local')->delete($path);
                    }
                }
                $fileName   = uniqid() . '.' . $file->getClientOriginalExtension();
                $img = Image::make($file->getRealPath());
                $img->stream();
                Storage::disk('local')->put('images/documents/'.$fileName, $img);
                $user->gst_document=$fileName;
            }
        }
        if ($req->hasFile('profile_image')) {
            if (!empty($user->profile_image) && $user->profile_image!=='default-profile.jpg') {
                $path='images/documents/'.$user->profile_image;
                if (Storage::disk('local')->exists($path)) {
                    Storage::disk('local')->delete($path);
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
            $user->profile_image=$fileName;
        }
        $user->status=1;    //for user verified
        $user->update($req->only(['name','contact_number','email','shop_name','address']));
        return $this->throwSuccessMessage('Profile updated Successfully', $user);
    }

    public function getUserInfo(Request $req)
    {
        $user=$req->user();
        return $this->throwSuccessMessage('User Information', $user);
    }
    public function getPrivacyPolicy()
    {
        return $this->decidePage('user', 'privacy_policy');
    }
    public function getTermsCondition()
    {
        return $this->decidePage('user', 'terms_condition');
    }
    public function getFAQ()
    {
        return $this->decidePage('common', 'faq');
    }
    public function getAboutUs()
    {
        return $this->decidePage('common', 'about_us');
    }
    private function decidePage($type="common", $slug='about_us')
    {
        $page=StaticPage::where('type', $type)->where('slug', $slug)->first();
        return view('staticpages.static_layout')->with(['page'=>$page]);
    }
}