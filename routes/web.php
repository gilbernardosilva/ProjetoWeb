<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use App\Http\Livewire\ProductsTable;
use App\Models\Product;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\GoogleController;
use App\Http\Controllers\Auth\TwitterController;
use App\Http\Controllers\Auth\FacebookController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\GameController;
use App\Http\Controllers\HeaderController;
use GuzzleHttp\Psr7\Header;

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
Route::get('/', function () {
    return view('index');
});
Route::get('/users', [UserController::class, 'index']);
Route::get('/users/create', [UserController::class, 'create']);
Route::post('/users', [UserController::class, 'store']);

Route::get('/shopping-cart', [ProductsTable::class,'showCart']);
Route::post('/shopping-cart', [ProductsTable::class,'removeFromCart']);
Route::post('/checkout', [ProductsTable::class,'checkout'])->name('checkout');
Route::get('/success', [ProductsTable::class,'success'])->name('checkout.success');
Route::get('/cancel', [ProductsTable::class,'cancel'])->name('checkout.cancel');
Route::post('/webhook', [ProductsTable::class,'webhook'])->name('checkout.webhook');
Route::get('search', [HeaderController::class,'searchProducts']);




Route::get('/', [ProductController::class,'index'])->name('mainpage');
Route::get('/products/create', [ProductController::class,'create']);
Route::post('/products', [ProductController::class, 'store']);

Route::get('/products/show/{product}/{user}',[ProductsTable::class,'show']);
Route::get('/games/create', [GameController::class, 'create']);
Route::post('/games', [GameController::class, 'store']);

Route::get('/categories/create', [CategoryController::class, 'create']);
Route::post('/categories', [CategoryController::class, 'store']);


Route::middleware(['auth:sanctum',config('jetstream.auth_session'),'verified'])->group(function () {

    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
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

