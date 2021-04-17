<?php

use Illuminate\Support\Facades\Route;

Route::get('/', fn () => redirect()->route('admin.login'));

Route::get('/login', fn () => view('admin.auth'))->name('admin.login');

//Handle UnAuthenticated Route
Route::group(
    ['namespace' => 'App\Http\Controllers\CRM'],
    function () {
        Route::post('/login/verify', 'AuthController@verifyAdmin')->name('admin.login.verify');
        Route::get('/logout', 'AuthController@logout')->name('admin.logout');
    }
);

//Authenticated Route
Route::group(
    ['middleware' => 'auth:admin', 'as' => 'admin.', 'namespace' => 'App\Http\Controllers\CRM'],
    function () {
        Route::get('dashboard', 'DashboardController')->name('dashboard');
        Route::get('/roles/status/{role}', 'RoleController@status')->name('roles.status');
        Route::resource('roles', 'RoleController');

        Route::get('/admins/status/{admin}', 'AdminController@status')->name('admins.status');
        Route::resource('admins', 'AdminController')->only(['index', 'show','create', 'store', 'edit', 'update']);

        Route::get('/users/status/{user}', 'UserController@status')->name('users.status');
        Route::get('/users/verify_gst/{user}', 'UserController@verify')->name('users.verify');
        Route::resource('users', 'UserController');

        Route::get('/users/status/{user}', 'UserController@status')->name('users.status');

        Route::get('/categories/request/reject/{id}', 'CategoryController@reject')->name('categories.reject');
        Route::post('/categories/request/approve', 'CategoryController@approve')->name('categories.approve');
        Route::get('/categories/delete/{id}', 'CategoryController@delete');
        Route::get('/categories/status/{id}', 'CategoryController@status');

        Route::get('/categories/requests', 'CategoryController@requests')->name('categories.requests');
        Route::resource('categories', 'CategoryController')->only('index', 'create', 'store', 'update');

        Route::get('/brands/status/{brand}', 'BrandController@status')->name('brands.status');
        Route::get('/brands/delete/{brand}', 'BrandController@delete')->name('brands.delete');
        Route::resource('brands', 'BrandController')->except(['show']);

        Route::get('/products/status/{product}', 'ProductController@status')->name('products.status');
        Route::resource('products', 'ProductController');
        Route::get('products/delete/{product}', 'ProductController@delete')->name('products.delete');

        Route::get('/enquiries/status/{enquiry}', 'EnquiryController@status')->name('enquiries.status');
        Route::resource('enquiries', 'EnquiryController');

        Route::resource('orders', 'OrderController')->only(['index', 'show', 'update']);
        Route::get('orders/invoice/{order}', 'OrderController@invoice')->name("orders.invoice");
        Route::get('orders/cancel/{order}', 'OrderController@cancelOrder')->name("orders.cancel");
        Route::get('orders/refund/{order}', 'OrderController@cancelOrderRefund')->name("orders.refund");
        Route::get('cancelorders', 'OrderController@cancelled')->name("cancelled.orders");
        Route::get('cancelorders/show/{order}', 'OrderController@cancelShow')->name("cancelled.orders.details");
        Route::resource('carts', 'CartController')->only(['index', 'show']);

        Route::get('/subscriptions/status/{subscription}', 'SubscriptionController@status')->name('subscriptions.status');
        Route::resource('subscriptions', 'SubscriptionController')->except(['show', 'destroy']);

        Route::get('/events/status/{event}', 'EventController@status')->name('events.status');
        Route::resource('galleries', 'GalleryController')->except(['show', 'destroy']);

        Route::get('/banners/status/{banner}', 'BannerController@status')->name('banners.status');
        Route::get('/banners/delete/{banner}', 'BannerController@delete')->name('banners.delete');
        Route::resource('banners', 'BannerController');

        Route::resource('votings', 'VoteController')->only(['index', 'create', 'store', 'destroy', 'show']);

        Route::resource('transactions', 'TransactionController')->only(['index', 'show']);
        Route::resource('filmsubmiteds', 'FilmSubmitedController')->only(['index', 'show']);
        Route::resource('posts', 'PostController');
        Route::get('posts/status/{id}', 'PostController@status')->name('posts.status');
        Route::get('posts/delete/{id}', 'PostController@delete')->name('posts.delete');
        Route::get('subcategories/{id}', 'PostController@chooseSubCategory')->name('subcategories');
       
        Route::resource('tags', 'TagController');
        Route::get('tags/status/{id}', 'TagController@status')->name('tags.status');
        Route::get('tags/delete/{id}', 'TagController@delete')->name('tags.delete');
        Route::resource('units', 'UnitController');
        Route::resource('staticpages', 'StaticPageController');
        
        Route::get('/reports', fn () => view('admin.pages.reports.index'))->name('reports');
    }
);

Route::get('/blank', fn () => view('admin.pages.blank'));
Route::get('/faq', fn () => view('staticpages.faq'));
