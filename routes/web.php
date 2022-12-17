<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Auth\GoogleController;
use App\Http\Controllers\Auth\TwitterController;
use App\Http\Controllers\Auth\FacebookController;
use App\Http\Controllers\User\ProfileController;
use GuzzleHttp\Middleware;

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

Route::get('/home', function () {
    return view('home');
});

Auth::routes();


Route::get('/dashboard', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::controller(ProfileController::class)->group(function(){
    Route::get('/profile', 'show')->name('profile.show');
    Route::post('profileUpdateUserInfo', 'updateUserInfo')->name('profile.updateUserInfo');
    Route::post('profileUpdateAddressInfo', 'updateAddressInfo')->name('profile.updateAddressInfo');
    Route::post('profileUpdatePhotoInfo', 'updatePhotoInfo')->name('profile.updatePhotoInfo');
})->middleware('auth');

Route::controller(GoogleController::class)->group(function(){
    Route::get('auth/google','redirectToGoogle')->name('auth.google');
    Route::get('auth/google/callback', 'handleCallback');
});

Route::controller(TwitterController::class)->group(function(){
    Route::get('auth/twitter','redirectToTwitter')->name('auth.twitter');
    Route::get('auth/twitter/callback', 'handleCallback');
});

Route::controller(FacebookController::class)->group(function(){
    Route::get('auth/facebook','redirectToFacebook')->name('auth.facebook');
    Route::get('auth/facebook/callback', 'handleCallback');
});
