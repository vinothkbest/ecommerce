<?php

namespace App\Http\Controllers\CRM;

use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $admins = Admin::get();
        return view('admin.pages.admins.index', ['admins' => $admins]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::where('status', 1)->get(['id', 'name']);
        return view('admin.pages.admins.create')->with('roles', $roles);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:admins,email',
            //'username' => 'required|min:6|unique:admins,username',
            'password' => 'required|min:6',
            'password_confirmation' => 'required|min:6|same:password',
            'roles' => 'required|array|min:1',
        ]);
        $admin = new Admin;
        $admin->name = $request->name;
        $admin->email = $request->email;
        //$admin->username = $req->username;
        $admin->password = $request->password;
        $admin->save();
        $admin->assignRole($request->roles);

        return redirect()->route('admin.admins.index')->with(['status' => 'success', 'message' => 'Admin created successfully']);
    }

    public function edit(Admin $admin)
    {
        $roles = Role::where('status', 1)->get(['id', 'name']);
        return view('admin.pages.admins.edit', ['admins' => $admin, 'roles' => $roles]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function update(Request $req, Admin $admin)
    {
        $this->validate($req, [
            'name' => 'required',
            'email' => 'required|email|unique:admins,email,' . $admin->id,
            //'username'=>'required|min:6|unique:admins,username,'.$admin->id,
            'roles' => 'required|array|min:1',
            'password' => [Rule::requiredIf($req->change_password == "on"), 'min:6'],
            'password_confirmation' => [Rule::requiredIf($req->change_password == "on"), 'min:6', 'same:password'],
        ]);
        $admin->name = $req->name;
        $admin->email = $req->email;
        //$admin->username = $req->username;
        if ($req->change_password == "on" && !empty($req->password)) {
            $admin->password = $req->password;
        }
        $admin->save();
        DB::table('model_has_roles')->where('model_id', $admin->id)->delete();
        $admin->assignRole($req->roles);

        return redirect()->route('admin.admins.index')->with(['status' => 'success', 'message' => $admin->name . ' updated successfully']);
    }

    public function status(Admin $admin)
    {
        $admin->status = !$admin->status;
        $admin->save();
        if ($admin->status) {
            return redirect()->route('admin.admins.index')->with(['status' => 'success', 'message' => $admin->username . ' username was activated']);
        } else {
            return redirect()->route('admin.admins.index')->with(['status' => 'error', 'message' => $admin->username . ' username was disabled']);
        }
    }
}
