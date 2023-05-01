<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/', [\App\Http\Controllers\WelcomePageController::class, 'index'])->name('welcome');
Route::get('/shop', [\App\Http\Controllers\ShopController::class, 'index'])->name('shop.index');
Route::get('/shop/{product}', [\App\Http\Controllers\ShopController::class, 'show'])->name('shop.show');
Route::get('/shop/search/{query}', [\App\Http\Controllers\ShopController::class, 'search'])->name('shop.search');


// Cart
Route::get('/cart', [\App\Http\Controllers\CartController::class, 'index'])->name('cart.index');
Route::post('/cart', [\App\Http\Controllers\CartController::class, 'store'])->name('cart.store');
Route::delete('/cart/{product}/{cart}', [\App\Http\Controllers\CartController::class, 'destroy'])->name('cart.destroy');
Route::post('/cart/save-later/{product}', [\App\Http\Controllers\CartController::class, 'saveLater'])->name('cart.save-later');
Route::post('/cart/add-to-cart/{product}', [\App\Http\Controllers\CartController::class, 'addToCart'])->name('cart.add-to-cart');
Route::patch('/cart/{product}', [\App\Http\Controllers\CartController::class, 'update'])->name('cart.update');

// checkout
Route::get('/checkout', [\App\Http\Controllers\CheckoutController::class, 'index'])->name('checkout.index')->middleware('auth');
Route::post('/checkout', [\App\Http\Controllers\CheckoutController::class, 'store'])->name('checkout.store')->middleware('auth');
Route::get('/guest-checkout', [\App\Http\Controllers\CheckoutController::class, 'index'])->name('checkout.guest');

// coupon
Route::post('/coupon', [\App\Http\Controllers\CouponsController::class, 'store'])->name('coupon.store');
Route::delete('/coupon/', [\App\Http\Controllers\CouponsController::class, 'destroy'])->name('coupon.destroy');

// auth routes
Auth::routes();
Route::get('/login/{provider}', 'Auth\LoginController@redirectToProvider');
Route::get('/login/{provider}/callback', 'Auth\LoginController@handleProviderCallback');

//Route::get('/home', 'HomeController@index')->name('home');

Route::group(['prefix' => 'admin'], function () {
    //Voyager::routes();
    Route::get('/country_visits', 'VisitsController@index')->name('voyager.visits');
});

Route::group(['middleware' => 'auth'], function() {
    Route::get('commandes', [\App\Http\Controllers\User\CommandeController::class, 'index'])->name('commandes');
    Route::delete('delete-commande/{commande_id}', [\App\Http\Controllers\User\CommandeController::class, 'destroy'])->name('supprimer_commande');
});
