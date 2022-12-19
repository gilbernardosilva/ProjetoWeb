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
use App\Http\Controllers\User\ProfileController;
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

Route::middleware(['auth'])->group(function(){


Route::controller(UserController::class)->group(function () {
    Route::get('/user','index')->name('user.index');
    Route::get('/user/create', 'create')->name('user.create');
    Route::post('/user/store','store')->name('user.store');
    Route::get('/user/show/{user}','show')->name('user.show');
    Route::get('/user/edit/{user}','edit')->name('user.edit');
    Route::post('/user/update/{user}', 'update')->name('user.update');
    Route::post('/user/destroy/{user}', 'destroy')->name('user.destroy');
    Route::get('/admin','admin')->name('admin');
    });

    Route::controller(AddressController::class)->group(function () {
        Route::get('/address','index')->name('address.index');
        Route::get('/address/create', 'create')->name('address.create');
        Route::post('/address/store/{user}','store')->name('address.store');
        Route::get('/address/show/{user}','show')->name('address.show');
        Route::get('/address/edit/{user}','edit')->name('address.edit');
        Route::post('/address/update/{user}', 'update')->name('address.update');
        Route::post('/address/destroy/{user}', 'destroy')->name('address.destroy');
    });

    Route::controller(PhotoController::class)->group(function () {
        Route::get('/photo','index')->name('photo.index');
        Route::get('/photo/create/{photo}', 'create')->name('photo.create');
        Route::post('/photo/store','store')->name('photo.store');
        Route::get('/photo/show/{photo}','show')->name('photo.show');
        Route::get('/photo/edit/{photo}','edit')->name('photo.edit');
        Route::post('/photo/update/{photo}', 'update')->name('photo.update');
        Route::post('/photo/destroy/{photo}', 'destroy')->name('photo.destroy');
    });



});


Route::controller(ProfileController::class)->group(function () {
    Route::get('/profile','show')->name('profile.show');
});










Route::get('/dashboard', function() {
    $user=Auth::user()->id;
    return view('home',compact('user'));
})->name('dashboard');


Route::controller(ProductController::class)->group(function(){
    Route::get('/products','index')->name('products.index');
    Route::get('/products/show/{product}', 'show')->name('products.show');
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
