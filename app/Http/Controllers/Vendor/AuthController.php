<?php

namespace App\Http\Controllers\Vendor;

use App\Models\Role;
use App\Models\Admin;
use App\Models\Vendor;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function verifyVendor(Request $request)
    {
        $this->validate($request, [
            'mobile_number' => 'required|exists:vendors,mobile_number',
            'password'=>'required'
        ], [
            'mobile_number.exists'=>'Your Mobile number not register with us yet.'
        ]);
        $vendor=Vendor::where('mobile_number', $request->mobile_number)->first();
        if ($vendor["status"]==0) {
            $errors = ['mobile_number' => 'Sorry!Your account was blocked.Please contact admin for further details'];
            return redirect()->back()->withInput()->withErrors($errors);
        }
        if (Auth::guard('vendor')->attempt($request->only('mobile_number', 'password'))) {
            return redirect()->route('vendor.dashboard');
        } else {
            return redirect()->back()->withInput()->withErrors(['password'=>'Incorrect username and / or password.']);
        }
        // $username = $request->username;
        // $password = $request->password;


        // $admin = Admin::where('username', $username)->first();
        // //return $admin;

        // if ($admin) {
        //     if (Auth::guard('admin')->attempt($request->only('username', 'password'))) {
        //         return redirect('admin/dashboard');
        //     } else {
        //         $errors = ['password' => 'Your Password not matching.'];
        //         return redirect()->back()->withInput()->withErrors($errors);
        //     }
        // } else {
        //     $errors = ['email' => 'Check your username'];
        //     return redirect()->back()->withInput()->withErrors($errors);
        // }
    }
    public function logout()
    {
        Auth::logout();
        return redirect()->route('vendor.login');
    }
}