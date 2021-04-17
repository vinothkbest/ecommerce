<?php

namespace App\Providers;

use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Eloquent\Relations\Relation;
use App\Models\Category;
use App\Models\Address;
use App\Models\User;
use App\Models\Cart;
use App\Models\Banner;
use Auth;
use View;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Paginator::useBootstrap();
        Schema::defaultStringLength(191);

        Relation::morphMap([
            'tag' => 'App\Models\Tag',
            'post' => 'App\Models\Post',
            'product' => 'App\Models\Product',
        ]);
        /**
        * @return Globally pass the categories at menu;
        */
        View::composer('*', function ($view) {
            $categories = Category::whereNull('parent_id')->with('subCategory')->get();
            $latest_user = User::latest()->first();
            $total_itmes = Cart::where('user_id', Auth::id())->count();
            $sliders = Banner::where('status', 1)->get();
            
            $view->with(['menus'=> $categories, 'latest_user' => $latest_user,
                         'total_itmes' => $total_itmes, "sliders" => $sliders]);
        
        });
    }
}
