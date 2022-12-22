<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\Auth\AuthController;

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
Route::group(['prefix'=>'v1'], function(){
    //Authentication
    Route::post('signup',[AuthController::class,'signup'])->name('signup');
    Route::post('login',[AuthController::class,'login'])->name('login');

    Route::apiResource("product",ProductController::class);
});

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
