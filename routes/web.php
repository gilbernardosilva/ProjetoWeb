<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Shop\GameController;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\User\PhotoController;
use App\Http\Controllers\Auth\GoogleController;
use App\Http\Controllers\Auth\TwitterController;
use App\Http\Controllers\Shop\ProductController;
use App\Http\Controllers\User\AddressController;
use App\Http\Controllers\User\ProfileController;
use App\Http\Controllers\Auth\FacebookController;
use App\Http\Controllers\MessagesController;
use App\Http\Controllers\Shop\CategoryController;
use App\Http\Controllers\Shop\PlatformController;
use App\Http\Controllers\User\ReviewController;
use App\Http\Livewire\ProductsTable;


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


Route::middleware('is_admin')->group(function () {
    Route::controller(UserController::class)->group(function () {
        Route::get('/users', 'index')->name('users.index');
        Route::get('/users/create', 'create')->name('users.create');
        Route::post('/users/store', 'store')->name('users.store');
        Route::get('/users/show/{user}', 'show')->name('users.show');
        Route::get('/users/edit/{user}', 'edit')->name('users.edit');
        Route::post('/users/update/{user}', 'update')->name('users.update');
        Route::post('/users/destroy/{user}', 'destroy')->name('users.destroy');
    });
    Route::controller(AddressController::class)->group(function () {
        Route::get('/addresses', 'index')->name('addresses.index');
        Route::get('/addresses/create', 'create')->name('addresses.create');
        Route::post('/addresses/store', 'store')->name('addresses.store');
        Route::get('/addresses/show/{address}', 'show')->name('addresses.show');
        Route::get('/addresses/edit/{address}', 'edit')->name('addresses.edit');
        Route::post('/addresses/update/{address}', 'update')->name('addresses.update');
        Route::post('/addresses/destroy/{address}', 'destroy')->name('addresses.destroy');
    });
    Route::controller(PhotoController::class)->group(function () {
        Route::get('/photos', 'index')->name('photos.index');
        Route::get('/photos/create', 'create')->name('photos.create');
        Route::post('/photos/store', 'store')->name('photos.store');
        Route::get('/photos/show/{photo}', 'show')->name('photos.show');
        Route::get('/photos/edit/{photo}', 'edit')->name('photos.edit');
        Route::post('/photos/update/{photo}', 'update')->name('photos.update');
        Route::post('/photos/destroy/{photo}', 'destroy')->name('photos.destroy');
    });
    Route::controller(ProductController::class)->group(function () {
        Route::get('/products', 'index')->name('products.index');
        Route::get('/products/show/{product}', 'show')->name('products.show');
        Route::get('/products/create', 'create')->name('products.create');
        Route::get('/products/edit/{product}', 'edit')->name('products.edit');
        Route::post('/products/store', 'store')->name('products.store');
        Route::post('/products/update/{product}', 'update')->name('products.update');
        Route::post('/products/destroy/{product}', 'destroy')->name('products.destroy');
    });
    Route::controller(GameController::class)->group(function () {
        Route::get('/games', 'index')->name('games.index');
        Route::get('/games/show/{game}', 'show')->name('games.show');
        Route::get('/games/create', 'create')->name('games.create');
        Route::get('/games/edit/{game}', 'edit')->name('games.edit');
        Route::post('/games/store', 'store')->name('games.store');
        Route::post('/games/update/{game}', 'update')->name('games.update');
        Route::post('/games/destroy/{game}', 'destroy')->name('games.destroy');
    });

    Route::controller(CategoryController::class)->group(function () {
        Route::get('/categories', 'index')->name('categories.index');
        Route::get('/categories/show/{category}', 'show')->name('categories.show');
        Route::get('/categories/create', 'create')->name('categories.create');
        Route::get('/categories/edit/{category}', 'edit')->name('categories.edit');
        Route::post('/categories/store', 'store')->name('categories.store');
        Route::post('/categories/update/{category}', 'update')->name('categories.update');
        Route::post('/categories/destroy/{category}', 'destroy')->name('categories.destroy');
    });

    Route::controller(PlatformController::class)->group(function () {
        Route::get('/platforms', 'index')->name('platforms.index');
        Route::get('/platforms/show/{platform}', 'show')->name('platforms.show');
        Route::get('/platforms/create', 'create')->name('platforms.create');
        Route::get('/platforms/edit/{platform}', 'edit')->name('platforms.edit');
        Route::post('/platforms/store', 'store')->name('platforms.store');
        Route::post('/platforms/update/{platform}', 'update')->name('platforms.update');
        Route::post('/platforms/destroy/{platform}', 'destroy')->name('platforms.destroy');
    });
});


Route::middleware('auth')->group(function () {
    Route::controller(ProfileController::class)->group(function () {
        Route::get('/profile/{user}', 'show')->name('profile.show');
        Route::get('/profile/edit/{user}', 'edit')->name('profile.edit');
        Route::post('/profile/updateAddress', 'updateAddress')->name('profile.updateAddress');
        Route::post('/profile/storeAddress', 'storeAddress')->name('profile.storeAddress');
        Route::post('/profile/updatePhoto', 'updatePhoto')->name('profile.updatePhoto');
        Route::post('/profile/storePhoto', 'storePhoto')->name('profile.storePhoto');
    });

    Route::controller(ReviewController::class)->group(function () {
            Route::get('/profile/review/create/{user}', 'create')->name('reviews.create');
            Route::post('/profile/review/store', 'store')->name('reviews.store');
    });

    Route::controller(MessagesController::class)->group(function () {
        Route::get('/dashboard', 'index')->name('messages.index');
        Route::get('/dashboard/create', 'create')->name('messages.create');
        Route::get('/dashboard/{id}', 'show')->name('messages.show');
        Route::post('/dashboard', 'store')->name('messages.store');
        Route::post('/dashboard/{id}', 'update')->name('messages.update');
    });

    Route::middleware('is_user')->group(function () {
        Route::controller(UserController::class)->group(function () {
            Route::get('/seller', 'createSeller')->name('user.seller');
            Route::post('/seller/store', 'storeSeller')->name('user.storeSeller');
        });

    });
});

Route::controller(ProductsTable::class)->group(function () {
    Route::get('/sort', 'index')->name('product.sort');
    Route::get('/shopping-cart', 'showCart');
    Route::post('/shopping-cart', 'removeFromCart');
    Route::post('/checkout', 'checkout')->name('checkout');
    Route::get('/success', 'success')->name('checkout.success');
    Route::get('/cancel', 'cancel')->name('checkout.cancel');
    Route::post('/webhook', 'webhook')->name('checkout.webhook');
    Route::get('/products/show/{product}/{user}', 'show');
    Route::get('search', 'searchProducts');

});


Route::controller(CategoryController::class)->group(function () {
    Route::get('/categories/products', 'allCategories')->name('livewire.products-list');
    Route::get('/categories/{category}', 'categories')->name('livewire.products-list');
});

Route::controller(PlatformController::class)->group(function () {
    Route::get('/platforms/products', 'allPlatforms')->name('livewire.products-list');
    Route::get('/platforms/{platform}', 'platforms')->name('livewire.products-list');
});

Route::controller(ProductController::class)->group(function () {
    Route::get('/', 'indexShop')->name('shop.index');
    Route::get('/product/add/', 'createProduct')->name('products.createProduct')->middleware('is_seller');
    Route::post('/product/store/', 'store')->name('products.storeProduct')->middleware('is_seller');
});

Route::controller(GoogleController::class)->group(function () {
    Route::get('auth/google', 'redirectToGoogle')->name('auth.google');
    Route::get('auth/google/callback', 'handleCallback');
});

Route::controller(TwitterController::class)->group(function () {
    Route::get('auth/twitter', 'redirectToTwitter')->name('auth.twitter');
    Route::get('auth/twitter/callback', 'handleCallback');
});

Route::controller(FacebookController::class)->group(function () {
    Route::get('auth/facebook', 'redirectToFacebook')->name('auth.facebook');
    Route::get('auth/facebook/callback', 'handleCallback');
});
