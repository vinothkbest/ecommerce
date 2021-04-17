<?php

use Illuminate\Support\Facades\Route;

Route::group(['namespace' => 'App\Http\Controllers\API\Vendor'], function () {
    Route::post("/login", "VendorController@loginVendor");
    Route::post("/verify/otp", "VendorController@verifyOTP");
    Route::post("/resend/otp", "VendorController@resendOTP");
    Route::get('/privacy_policy', "VendorController@getPrivacyPolicy");
    Route::get('/terms_condition', "VendorController@getTermsCondition");
    Route::get('/faq', "VendorController@getFAQ");
    Route::get('/about_us', "VendorController@getAboutUs");

    Route::group(['middleware'=>'auth:sanctum'], function () {

        //Profile Related routes
        Route::post("/update", "VendorController@updateVendor");
        Route::get("/verify/token", "VendorController@verifyToken");
        Route::get("/get/profile", "VendorController@getVendorInfo");

        Route::get("/get/home_data", "HomeController@getHomeData");

        Route::post("/get/category_list", "CategoryController@getCategoryList");
        Route::post("/get/product_list", "ProductController@getProductList");
        Route::post("/get/product_detail", "ProductController@getProductDetail");

        //Enquiry
        Route::get("/get/enquiry", "EnquiryController@getEnquiry");

        Route::get("/get/orders", "OrderController@getOrders");
        Route::post("/get/order/products", "OrderController@getOrderProducts");
        Route::post("/get/order/product/variants", "OrderController@getOrderProductVariants");

        // Route::get("/get/banner_data", "HomeController@getBannerData");
    });

    Route::group(['middleware'=>'OptionalAuthSanctum'], function () {
        //Category operations
        Route::get("/get/category", "CategoryController@getCategory");
        Route::get("/get/brands", "BrandController@getBrands");
    });
});
