<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use Validator;
use App\Models\User;
use App\Models\Address;
use Carbon\Carbon;
use Hash;
use app\Helper\Sms;

class UserController extends Controller
{
    
	public function profile(){
        $addresses = Address::where('user_id', Auth::id())->OrderByDesc('is_default')->get();
    	return view('website.pages.profile', compact('addresses'));
    }

    public function userForm($form){
        //return $form;

        if($form == "register" || $form == "login" || $form=="forgot"){

            return view('website.pages.user-form', compact('form'));
        }
           
        else{
            return 'No Page Found!';
        }
    }
    public function otpVerifyForm(){
        return view('website.pages.user-otp');
    }
    public function register(Request $request){
        $otp = mt_rand(1000, 9999);
        $message = "OTP has been sent ". $otp;
        $user_data = ["name" => ucwords($request->name), "mobile" => $request->mobile,
                      "email" => $request->email, "password" => Hash::make($request->password),
                      "otp_created_at" => Carbon::now(), "otp" => $otp];
        
        User::create($user_data);
        /**
        * @see calling middleware
        */

        session()->put('is_registered', true);

        return redirect('form-user/otp');
       
    }
    
    public function isSameUser(Request $request){
       if($request->ajax()){
                
                $exist_email = User::where('email', $request->email);
                $exist_mobile = User::where('mobile', $request->mobile);

                if($exist_email->first() && $exist_mobile->first()){
                    return 3;
                }
                elseif($exist_email->first() && !$exist_mobile->first()){
                    return 2;
                }
                elseif(!$exist_email->first() && $exist_mobile->first()){
                    return 1;
                }
                return 0;
       }

    }
    
    public function otpVerifyAuthenticate(Request $request){

        if($request->type == 'otp_verify'){
            
            $user=User::where(['mobile' => $request->mobile, 'otp' => $request->otp])->first();

            if($user){
                $otp_created_second = Carbon::parse(strtotime($user->otp_created_at))->addSeconds(60);
                
                /**
                * @var otp expiration check
                */
                if($otp_created_second >= Carbon::now()){

                    $user->otp_verification_status=1;
                    $user->status=1;
                    $user->save();                     

                    if(Auth::loginUsingId($user->id)){
                        $message = "Registration has been completed and logged in successfully";
                        $session = "success";
                        session()->forget('is_registered');
                        return redirect('/')->with($session, $message);
                    }
                }
                else{
                    $session = "error";
                    $message = "OTP has been expired!";
                    return redirect()->back()->with($session, $message);
                }
            }
            
            else{
                $session = "error";
                $message = "OTP is not matched!";
                return redirect()->back()->with($session, $message);
            }
        }

        elseif ($request->type == 'login') {

            if(Auth::guard('web')->attempt($request->only('mobile', 'password'))){
                $message = "User has been logged in successfully";
                $session = "success";
                return redirect('/')->with($session, $message);
            }
            else{
                $session = "error";
                $message = "Username/passwaord are not matched!";
                return redirect()->back()->with($session, $message);
            }
        }
        elseif($request->type == 'otp_resend'){
            $user=User::where('mobile', $request->mobile)->first();
            /**
            *   if expired, regenerate the otp
            */
            if($user){
                $otp = mt_rand(1000, 9999);
                $user->otp = $otp;
                $message = "OTP has been sent ". $otp;
                $user->otp_created_at = Carbon::now();
                $user->save();
                return redirect('form-user/otp');
            }
        }
    }

    public function mobileExist(Request $request){
        if($request->ajax()){
            $user=User::where(['mobile' => $request->mobile])->count();
            if($user ==1){
                return true;
            }
             return false;
        }
    }

    public function forgotPassword(Request $request){
        session()->put('is_registered', true);
        session()->put('otp-mobile', $request->mobile);
        
        $user = User::where('mobile', $request->mobile)->first();
        
        if($user){
            $otp = mt_rand(1000, 9999);
            $user->otp = $otp;
            $message = "OTP has been sent ". $otp;
            $user->otp_created_at = Carbon::now();
            $user->save();
            return redirect('form-user/reset');
        }

    }
    public function resetPasswordForm(){
        $current_user = User::where('mobile', session('otp-mobile'))->first();
        return view('website.pages.reset-password', compact('current_user'));
    }
    
    public function reset(Request $request){
        $user=User::find($request->user);
        
        if($request->type == 'otp_verify' && $user){

            $otp_created_second = Carbon::parse(strtotime($user->otp_created_at))->addSeconds(60);
        
            if($otp_created_second >= Carbon::now()){
                $user->password = Hash::make($request->password);
                $user->save();
            
                if(Auth::guard('web')->attempt($request->only('otp', 'password'))){
                    $message = "Password has been reset & logged in successfully";
                    $session = "success";
                    session()->forget('is_registered');
                    session()->forget('otp-mobile');
                    return redirect('/')->with($session, $message);
                }
            }
            else{
                $session = "error";
                $message = "OTP has been expired!";
                return redirect()->back()->with($session, $message);
            }

        }
        elseif ($request->type == 'otp_resend' && $user) {
                $otp = mt_rand(1000, 9999);
                $user->otp = $otp;
                $message = "OTP has been sent ". $otp;
                $user->otp_created_at = Carbon::now();
                $user->save();
                return redirect('form-user/reset');
        }

    }

    public function updateProfileWithAddress(Request $request){

        //return $request->is_default;

        if($request->type == "profile"){
                $user = User::find(Auth::id());
                $user->name = ucwords($request->name);
                $user->email = $request->email;
                $user->save();
                $message= "User Profile has been updated";
        }
        else{
            
            if(count(Auth::user()->addresses) > 0)
                  $primary_address = ($request->is_default) ? 1 : 0;
            else
                  $primary_address = 1;

            $address = ['user_id' => Auth::id(), 'door_number' => $request->door_number, 'street' => ucfirst($request->street), 'area' => ucfirst($request->area), 'city' => ucfirst($request->city), 'state' => $request->state, 'country' => $request->country, 'pin_code' => $request->pin,'is_default' => $primary_address];

            if($request->address_id){
               //Update address
                Address::where('id', $request->address_id)->update($address);

                if($request->is_default){

                    Address::where('id', '!=', $request->address_id)->where('user_id', Auth::id())->update(['is_default' => 0]);
                }
                $message= "User Address has been updated";
                
            }
            else{
                if($request->is_default){
                    
                    Address::where('status', 1)->where('user_id', Auth::id())->update(['is_default' => 0]);
                }
                //New address
                Address::create($address);
                $message= "User Address has been added";
            }
            
        }

        return redirect()->route('user.profile')->with("success", $message);
    }
    
    public function addressRemove($id){
        Address::find($id)->delete();
        return redirect()->route('user.profile')->with("success", "Address has been deleted!"); 
    }


    public function logout(){
        Auth::logout();
        return redirect('/');
    }
}
