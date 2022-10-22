<?php

use App\Http\Controllers\UserFacebookController;
use App\Http\Controllers\UserGoogleController;
use Illuminate\Support\Facades\Route;



Route::get('/googlelogin', function () {
    return view('google.userlogin');
})->name('google.userLogin');

Route::get('/unauthenticated', function () {
    return view('unauthenticated');
})->name('unauthenticated');

Route::get('/resetpassword', function () {
    return view('reset_password_page');
})->name('resetpasswordpage');

Route::get('/facebooklogin', function () {
    return view('facebook.userlogin');
})->name('facebook.userLogin');

Route::get('/userdashboard', function () {
    return view('userdashboard.dashboard');
});

// --------------------------Google Login-----------------------------
Route::post('auth/user/google',[UserGoogleController::class,'redirect'])->name('user_google');
Route::get('login/google/callback',[UserGoogleController::class,'handleCallback'])->name('google-callback');
// --------------------------Google Login-----------------------------

// --------------------------Facebook Login-----------------------------
Route::post('auth/user/facebook',[UserFacebookController::class,'redirect'])->name('user_facebook');
Route::get('login/facebook/callback',[UserFacebookController::class,'handleCallback'])->name('facebook-callback');
// --------------------------Facebook Login-----------------------------


