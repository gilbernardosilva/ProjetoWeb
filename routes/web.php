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

Route::middleware(['auth','user.access'])->group(function(){


Route::controller(UserController::class)->group(function () {
    Route::get('/users','index')->name('users.index');
    Route::get('/users/show/{user}','show')->name('users.show');
    Route::get('/users/edit/{user}','edit')->name('users.edit');
    Route::get('/users/create', 'create')->name('users.create');
    Route::post('/users/update/{user}', 'update')->name('users.update');
    Route::post('/users/store/{user}','store')->name('users.store');
    Route::post('/users/destroy/{user}', 'destroy')->name('users.destroy');
    });


    Route::controller(AddressController::class)->group(function () {
        Route::post('/address/store/{user}','store')->name('address.store');
        Route::post('/address/update/{user}','update')->name('address.update');
    });
});


Route::get('/dashboard', function() {
    $user=Auth::user()->id;
    return view('home',compact('user'));
})->name('dashboard');


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
