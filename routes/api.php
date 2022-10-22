<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ResetPasswordController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::post('registeruser',[UserController::class,'userRegister'])->name('userregister');
Route::post('login',[AuthController::class,'userLogin'])->name('userlogin');
Route::post('resetpassemail',[UserController::class,'resetPassEmail'])->name('resetpassemail');
Route::post('resetpassword',[ResetPasswordController::class,'resetPassword'])->name('resetpassword');

//----------------User Protected Routes----------------

Route::group(['middleware'=>'auth:api'],function(){
    Route::get('userinfo',[UserController::class,'userInfo'])->name('userinfo');
});

//----------------User Protected Routes----------------