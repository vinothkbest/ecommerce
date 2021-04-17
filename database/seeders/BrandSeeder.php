<?php

namespace Database\Seeders;

use App\Models\Brand;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class BrandSeeder extends Seeder
{
    public function run()
    {
        $json=File::get("database/seeders/brand.json");
        $datas=json_decode($json);
        foreach ($datas as $data) {
            $brand=new Brand;
            $brand->name=$data;
            $brand->image=uniqid().'.jpg';
            $brand->save();
        }
    }
}
