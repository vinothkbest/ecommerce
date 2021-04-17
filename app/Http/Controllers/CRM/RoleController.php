<?php

namespace App\Http\Controllers\CRM;

use App\Models\Module;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Permission;

class RoleController extends Controller
{
    public function index()
    {
        $roles=Role::get();
        return view('admin.pages.roles.index')->with(['roles'=>$roles]);
    }

    public function create()
    {
        $modules=Module::get();
        return view('admin.pages.roles.create')->with(['modules'=>$modules]);
    }

    public function store(Request $req)
    {
        $this->validate($req, [
            'name' => 'required|unique:roles,name',
            'permission' => 'required',
        ]);
        $role =new Role();
        $role->name = $req->name;
        $role->guard_name = "admin";
        $role->save();
        $role->syncPermissions($req->permission);

        return redirect()->route('admin.roles.index')
                        ->with('success', 'Role created successfully');
    }

    public function show(Role $role)
    {
    }

    public function edit(Role $role)
    {
        $permissions=Permission::get();
        $modules = Module::get();
        //$permissionss=$role->permissions;
        //return $permissionss;
        $rolePermissions = DB::table("role_has_permissions")->where("role_has_permissions.role_id", $role->id)
            ->pluck('role_has_permissions.permission_id', 'role_has_permissions.permission_id')
            ->all();

        //return  $rolePermissions;
        return view('admin.pages.roles.edit', compact('role', 'modules', 'permissions', 'rolePermissions'));
    }

    public function update(Request $request, Role $role)
    {
        $this->validate($request, [
            'name' => 'required',
            'permission' => 'required',
        ]);
        $role->name = $request->input('name');
        $role->save();


        $role->syncPermissions($request->input('permission'));


        return redirect()->route('admin.roles.index')
                        ->with('success', 'Role updated successfully');
    }

    public function destroy(Role $role)
    {
        //
    }
    public function status(Role $role)
    {
        $role->status=!$role->status;
        $role->save();
        if ($role->status) {
            return redirect()->route('admin.roles.index')->with(['status'=>'success','message'=>'Role activated']);
        } else {
            return redirect()->route('admin.roles.index')->with(['status'=>'success','message'=>'Role deactivated']);
        }
    }
}
