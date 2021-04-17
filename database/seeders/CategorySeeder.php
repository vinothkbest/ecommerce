<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $json=File::get("database/seeders/category.json");
        $datas=json_decode($json);
        $this->loop($datas);
    }
    private function loop($data, $id=null)
    {
        collect($data)->each(function ($ele, $ind) use ($id) {
            $category=new Category;
            $category->parent_id=$id;
            $category->name=$ele->label;
            $category->save();
            if (count($ele->data)!=0) {
                $this->loop($ele->data, $category->id);
            }
        });
    }
}
