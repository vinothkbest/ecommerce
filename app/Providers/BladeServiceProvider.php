<?php

namespace App\Providers;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class BladeServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        Blade::directive('selector', function ($expression) {
            list($a, $b)=explode(',', $expression);   //Object destructuring
            return "<?php echo $a==$b?'selected':'' ?>";
        });
    }
}
