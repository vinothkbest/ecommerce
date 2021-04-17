<?php

namespace App\Http\Controllers\CRM;

use App\Models\Role;
use App\Models\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function verifyAdmin(Request $request)
    {
        //return $request;
        $this->validate($request, [
            'name' => 'required|exists:admins,name',
            'password' => 'required'
        ], [
            'name.exists' => 'Name does not exists'
        ]);
        $admin = Admin::where('name', $request->name)->first();
        if ($admin["status"] == 0) {
            $errors = ['username' => 'Sorry!Your account was blocked.Please contact admin for further details'];
            return redirect()->back()->withInput()->withErrors($errors);
        }
        //dd(Auth::guard('admin')->attempt($request->only('name', 'password')));
        if (Auth::guard('admin')->attempt($request->only('name', 'password'))) {
            return redirect()->route('admin.dashboard');
        } else {
            return back()->withInput()->withErrors(['password' => 'Incorrect username and / or password.']);
        }
    }
    public function logout()
    {
        Auth::guard('admin')->logout();
        return redirect()->route('admin.login');
    }
}
