<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Admin;
use Hash;

class LoginSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Admin::create(['name' => 'Edward Jose', 'email' => 'edward@ninositsolution.com', 'password' => Hash::make('admin321')]); //dunning!sam
    }
}
