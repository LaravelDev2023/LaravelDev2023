<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserRegistration;
use App\Http\Controllers\UserProfile;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\BrandsController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\HomePageIndex;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('user_mainpage');
// })->name('home');

Route::controller(HomePageIndex::class)->group(function(){
    Route::get('/','index')->name('home');
    Route::get('/view-product/{product:product_code}', 'productInfo')->name('product_info');
    Route::get('/list-product', 'productList')->name('product_list');
});

Route::resource('cart', \App\Http\Controllers\CartController::class);

Route::controller(UserRegistration::class)->group(function () {
    Route::get('countries','index')->name('countries');
    Route::get('register','UserRegistration')->name('register');
    Route::post('register','UserRegistrationForm')->name('user_register');
    Route::get('login','UserLogin')->name('login');
    Route::post('login','UserLoginForm')->name('login')->name('user_login');
    Route::get('logout','UserLogout')->name('logout');
    Route::get('resetpassword','UserResetPassword')->name('resetpassword');
    Route::post('resetpassword','UserResetPasswordForm')->name('login')->name('resetpasswordform');
    Route::get('reset-password/{token}','resetPassword')->name('reset-password');
    Route::post('reset-password-data','resetPasswordData')->name('reset-password-data');
});

Route::controller(UserProfile::class)->group(function () {
    Route::get('user_profile','UserProfile')->name('user_profile');
    Route::post('user_profile_update','UserProfileUpdate')->name('user_profile_update');
    Route::post('user_profile_image_update','updateUserImage')->name('user_profile_image_update');
    
});

Route::group(['prefix' => '/admin', 'middleware' => ['checkUser']], function(){
    Route::controller(AdminController::class)->group(function () {
        
        Route::get('/', 'index')->name('admin_home');
        Route::get('all_user', 'allUserList')->name('all_user');
        Route::get('edit_user/{id}', 'editUserData')->name('edit_user');
        Route::put('update_user/{id}', 'updateUserByAdmin')->name('update_user');
        Route::post('update_user_image/{id}', 'updateUserImageByAdmin')->name('update_user_image');
        Route::get('add_user', 'addUserByAdmin')->name('add_user');
        Route::post('add_new_user_data', 'addUserDataByAdmin')->name('add_new_user_data');
        Route::get('deactivate_user/{id}/{status?}', 'deactivateUserByAdmin')->name('deactivate_user');
        
    });


    Route::resource('brands',BrandsController::class);
    Route::controller(BrandsController::class)->group(function () {
        Route::get('deactivate_brands/{id}/{status?}', 'deactivateBrandsByAdmin')->name('deactivate_brands');
    });

    //Product model start
    Route::resource('product',ProductController::class);
    Route::controller(ProductController::class)->group(function () {
        Route::get('deactivate_product/{id}/{status?}', 'deactivateProductByAdmin')->name('deactivate_product');
    });

    
});