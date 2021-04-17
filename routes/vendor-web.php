<?php

use Illuminate\Support\Facades\Route;

Route::get('/', fn () => redirect()->route('vendor.login'));

Route::get('/login', fn () => view('vendor.auth'))->name('vendor.login');

//Handle UnAuthenticated Route
Route::group(
    ['namespace' => 'App\Http\Controllers\Vendor'],
    function () {
        Route::post('/login/verify', 'AuthController@verifyVendor')->name('vendor.login.verify');
        Route::get('/logout', 'AuthController@logout')->name('vendor.logout');
    }
);

//Authenticated Route
Route::group(
    ['middleware'=>'auth:vendor','as'=>'vendor.','namespace' => 'App\Http\Controllers\Vendor'],
    function () {
        Route::get('dashboard', 'DashboardController')->name('dashboard');

        Route::resource('categories', 'RequestCategoryController')->except('destroy', 'show');

        Route::get('/products/status/{product}', 'ProductController@status')->name('products.status');
        Route::resource('products', 'ProductController');

        Route::get('/enquiries/status/{enquiry}', 'EnquiryController@status')->name('enquiries.status');
        Route::resource('enquiries', 'EnquiryController');

        Route::resource('orders', 'OrderController')->only(['index', 'show']);

        Route::resource('transactions', 'TransactionController')->only(['index','show']);


        Route::get('/reports', fn () => view('vendor.pages.reports.index'))->name('reports');

        
    }
);

Route::get('/blank', fn () => view('vendor.pages.blank'));