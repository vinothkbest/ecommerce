<?php

namespace Database\Seeders;

use App\Models\Module;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Str;
use Schema;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints();
        Module::truncate();
        Permission::truncate();
        Schema::enableForeignKeyConstraints();

        $modules = [
            "Dashboard",
            "Roles",
            "Admins",
            "Users",
            "Categories",
            "Brands",
            "Products",
         ];

        $per_names=['List','Add','View','Edit','Status','Delete'];

        foreach ($modules as $module) {
            $create_module=new Module();
            $create_module->name=$module;
            $create_module->save();
            foreach ($per_names as $per_name) {
                $permis=new Permission();
                $permis->module_id=$create_module->id;
                $permis->operation=$per_name;
                $permis->name=Str::of($module)->singular()->lower().'-'.Str::lower($per_name);
                //$permis->status=1;
                $permis->guard_name='admin';
                $permis->save();
            }
        }
    }
}
