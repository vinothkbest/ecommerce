<?php

use Illuminate\Support\Facades\Route;

Route::group(['namespace' => 'App\Http\Controllers\Website'], function () {
	
	Route::get('/', 'HomeController@index');
	/**
	*@see static pages
	*/
	Route::get('about', 'HomeController@about');
	Route::get('contact', 'HomeController@contact');
	Route::get('cancellation-policy', 'HomeController@cancellationPolicy');
	Route::get('privacy-policy', 'HomeController@privacyPolicy');
	Route::get('shipping-policy', 'HomeController@shippingPolicy');
	Route::get('terms-conditions', 'HomeController@termsConditions');
	Route::get('search', 'HomeController@search')->name("search");
	/**
	* @see product
	*/
	Route::get('category/{category}', 'ProductController@list')->name('product.list');
	Route::post('products', 'ProductController@products');
	Route::post('product-filter', 'ProductController@filter');
	Route::get('products/{product}', 'ProductController@detail')->name('product.detail');
	
	Route::group(['as' => 'user.'], function () {
		/**
		* @see register/login
		*/
		Route::get('form/{name}', 'UserController@userForm')->name('form');
		Route::post('register', 'UserController@register')->name('form.register');
		Route::get('form-user/otp', 'UserController@otpVerifyForm')->middleware('user.register');
		Route::post('same-user', 'UserController@isSameUser')->name('same');
		Route::post('login', 'UserController@otpVerifyAuthenticate')->name('form.auth');
		/**
		* @see forgot
		*/
		Route::post('forgot-password', 'UserController@forgotPassword')->name('forgot');
		Route::post('is-mobile-exist', 'UserController@mobileExist')->name('exist');
		Route::post('reset-password', 'UserController@reset')->name('form.reset');
		Route::get('form-user/reset', 'UserController@resetPasswordForm')->middleware('user.register');

		Route::group(['middleware' => 'auth:web', 'prefix'=>'user'], function() {
		    Route::get('profile', 'UserController@profile')->name('profile');
		    Route::get('logout', 'UserController@logout')->name('logout');
		    Route::post('edit-profile', 'UserController@updateProfileWithAddress')->name('edit.profile');
		    Route::get('address-delete/{id}', 'UserController@addressRemove')->name('address.delete');
		    /**
			* @see cart
			*/
		    Route::get('carts', 'CartController@items')->name('cart.itmes');
		    Route::post('add-items-to-cart', 'CartController@addTo')->name('cart.add');
		    Route::get('cart-items-remove/{cart}', 'CartController@removeCart');
		    Route::get('shipping-summary', 'CartController@shippingDetail')->name('shipping.detail');
		    /**
		    *@see myorder
		    */
		    Route::post('order-pay', 'UserOrderController@makePayment')->name('order.pay');
		    Route::get('my-order', 'UserOrderController@myOrder');
		});
	});
	
});