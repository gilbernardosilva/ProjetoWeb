<?php

use GuzzleHttp\Middleware;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\GoogleController;
use App\Http\Controllers\Auth\TwitterController;
use App\Http\Controllers\Shop\ProductController;
use App\Http\Controllers\Auth\FacebookController;
use App\Http\Controllers\User\AddressController;
use App\Http\Controllers\User\PhotoController;
use App\Http\Controllers\User\UserController;

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





Auth::routes();

Route::middleware('auth')->group(function(){

Route::controller(UserController::class)->group(function () {
    Route::get('/users/{id}', 'show');
    Route::post('/users', 'store')->name('users.store');

});

Route::get('/profile', function () {
    $user=Auth::user();
    return view('users.profile',compact('user'));
})->name('users.profile');

Route::controller(AddressController::class)->group(function () {
    Route::get('/address/{id}', 'show');
    Route::post('/address', 'store')->name('address.store');
});
Route::controller(PhotoController::class)->group(function () {
    Route::get('/photos/{id}', 'show');
    Route::post('/photos', 'store')->name('photos.store');
});
});



Route::controller(ProductController::class)->group(function(){
    Route::get('/products','index')->name('products.index');
    Route::get('/products/{product}', 'show')->name('products.show');
});

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
