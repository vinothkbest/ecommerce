<?php

use Illuminate\Support\Facades\Route;

Route::group(['namespace' => 'App\Http\Controllers\API\User'], function () {
    Route::post("/login", "UserController@loginUser");
    Route::post("/verify/otp", "UserController@verifyOTP");
    Route::post("/resend/otp", "UserController@resendOTP");
    Route::get('/privacy_policy', "UserController@getPrivacyPolicy");
    Route::get('/terms_condition', "UserController@getTermsCondition");
    Route::get('/faq', "UserController@getFAQ");
    Route::get('/about_us', "UserController@getAboutUs");

    //Protected routes with sanctum
    Route::group(['middleware'=>'auth:sanctum'], function () {

        //user opertions
        Route::post("/update", "UserController@updateUser");
        Route::get("/verify/gst", "UserController@changeGSTVerified");
        Route::get("/verify/token", "UserController@verifyToken");
        Route::get("/get/profile", "UserController@getUserInfo");

        //Product Operations
        Route::post("/get/product_detail", "ProductController@getProductDetail");

        //User's Operations
        //Wishlist
        Route::get("/get/wishlist", "WishlistController@getWishlist");
        Route::post("/add/wishlist", "WishlistController@addWishlist");
        //Enquiry
        Route::get("/get/enquiry", "EnquiryController@getEnquiry");
        Route::post("/add/enquiry", "EnquiryController@addEnquiry");
        //Bag
        Route::get("/get/bag", "BagController@getBag");
        Route::post("/add/bag", "BagController@addBag");

        Route::post("/add/order", "OrderController@addOrder");
        Route::get("/get/orders", "OrderController@getOrders");
        Route::post("/get/order/products", "OrderController@getOrderProducts");
        Route::post("/get/order/product/variants", "OrderController@getOrderProductVariants");
    });

    Route::group(['middleware'=>'OptionalAuthSanctum'], function () {
        //Category operations
        Route::get("/get/category", "CategoryController@getCategory");
        Route::post("/get/category_list", "CategoryController@getCategoryList");

        //Product Operations
        Route::post("/get/product_list", "ProductController@getProductList");

        //Other Operations
        Route::get("/get/banner_data", "HomeController@getBannerData");
        Route::get("/get/brands", "BrandController@getBrands");
        Route::get("/get/home_data", "HomeController@getHomeData");
    });
});