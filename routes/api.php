<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\OrderController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Controller;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
// category
Route::get('/homepage/categories', [CategoryController::class,'index']);
Route::get('/category/{id}', [CategoryController::class,'getCategory']);
Route::get('/categories', [CategoryController::class,'index']);
// search
Route::post('/hompage/search', [ProductController::class,'search']);

Route::post('login', [UserController::class,'login']);
    Route::post('register', [UserController::class,'register']);
    Route::get('/products', [ProductController::class,'index']);
    Route::post('/upload-file', [ProductController::class,'uploadFile']);
    Route::get('/products/{product}', [ProductController::class,'show']);

Route::group(['middleware' => 'auth:api'], function(){
    Route::get('/users',[UserController::class,'index']);
    Route::get('users/{user}',[UserController::class,'show']);
    Route::patch('users/{user}',[UserController::class,'update']);
    Route::get('users/{user}/orders',[UserController::class,'showOrder']);
    Route::patch('products/{product}/units/add',[ProductController::class,'updateUnits']);
    Route::delete('/admin/{id}/deleteProduct',[ProductController::class,'destroy']);
    Route::patch('orders/{order}/deliver',[OrderController::class,'deliverOrder']);
    Route::resource('/orders', OrderController::class);
    Route::resource('/products', ProductController::class)->except(['index','show']);
});
