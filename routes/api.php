<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserManagementController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\AuthenticationController;
use App\Http\Controllers\ProductController;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::post('register',[AuthenticationController::class,'register']);
Route::post('login',[AuthenticationController::class,'login']);
Route::post('forgot-password',[AuthenticationController::class,'generateResetCode']);
Route::post('reset-password',[AuthenticationController::class,'resetPassword']);




Route::middleware('auth:sanctum')->group(function (){

    Route::delete('role/{id}', [\App\Http\Controllers\RoleController::class,'deleteRole']);

    Route::controller(UserManagementController::class)->group(function (){
        Route::prefix('UserManagement')->group(function (){
            Route::get('user/{id}','userDetails')
                ->whereNumber('id');
            Route::put('user/{id}','userUpdate');
            Route::delete('user/{id}','userDelete');
            Route::middleware('admin')->group(function (){
                Route::get('users','userList');
                Route::post('user/create','userStore');
            });
        });
    });

    Route::get('user',[AuthenticationController::class,'user']);
    Route::get('logout',[AuthenticationController::class,'logout']);

    Route::prefix('ProductManagement')->group(function (){
        Route::controller(ProductController::class)->group(function ()
        {
            Route::post('product/create','storeProduct');
            Route::get('products','listProduct');
            Route::get('product/{id}','ShowProduct');
            Route::put('product/{id}','updateProduct');
            Route::delete('product/{id}','deleteProduct');

        });
    });

//    Route::controller(PostController::class)->group(function (){
//        Route::prefix('PostManagement')->group(function (){
//            Route::get('posts','postList');
//            Route::get('post/{id}','postDetails')->whereNumber('id');
//            Route::post('post/create','postStore');
//            Route::put('post/{id}','postUpdate');
//            Route::delete('post/{id}','postDelete');
//        });
//    });
});



