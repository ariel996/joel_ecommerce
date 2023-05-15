<?php

use App\Http\Controllers\AvisController;
use Illuminate\Support\Facades\Auth;
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
Route::delete('/coupon', [\App\Http\Controllers\CouponsController::class, 'destroy'])->name('coupon.destroy');

// auth routes
Auth::routes();
Route::get('/login/{provider}', [\App\Http\Controllers\Auth\LoginController::class, 'redirectToProvider']);
Route::get('/login/{provider}/callback', [\App\Http\Controllers\Auth\LoginController::class,'handleProviderCallback']);

//Route::get('/home', 'HomeController@index')->name('home');

Route::group(['middleware' => 'auth'], function() {
    //Avis
    Route::post('post_avis', [AvisController::class, 'store'])->name('post_avis');
    // Commandes
    Route::get('commandes', [\App\Http\Controllers\User\CommandeController::class, 'index'])->name('commandes');
    Route::delete('delete-commande/{commande_id}', [\App\Http\Controllers\User\CommandeController::class, 'destroy'])->name('supprimer_commande');

    // Messages
    Route::get('messages', [\App\Http\Controllers\User\MessageController::class, 'index'])->name('messages');
    Route::get('ecrire_message', [\App\Http\Controllers\User\MessageController::class, 'create'])->name('ecrire_message');
    Route::post('poster_message', [\App\Http\Controllers\User\MessageController::class, 'store'])->name('poster_message');
    Route::get('voire_message/{id}', [\App\Http\Controllers\User\MessageController::class, 'show'])->name('voire_message');
    Route::get('reply_message/{id}', [\App\Http\Controllers\User\MessageController::class, 'edit'])->name('reply_message');
    Route::post('post_reply/{id}', [\App\Http\Controllers\User\MessageController::class, 'reply_message'])->name('post_reply');
    Route::delete('delete-message/{id}', [\App\Http\Controllers\User\MessageController::class, 'destroy'])->name('delete-message');

    // Adresses
    Route::get('adresses', [\App\Http\Controllers\User\AdresseController::class, 'index'])->name('adresses');
    Route::get('ajouter-adresse', [\App\Http\Controllers\User\AdresseController::class, 'create'])->name('ajouter-adresse');
    Route::post('stock-adresse', [\App\Http\Controllers\User\AdresseController::class, 'store'])->name('stock-adresse');
    Route::get('modifier-adresse/{id}', [\App\Http\Controllers\User\AdresseController::class, 'edit'])->name('modifier-adresse');
    Route::put('update-adresse/{id}', [\App\Http\Controllers\User\AdresseController::class, 'update'])->name('update-adresse');
    Route::delete('delete-adresse', [\App\Http\Controllers\User\AdresseController::class, 'destroy'])->name('delete-adresse');

    // Profile
    Route::get('profil', [\App\Http\Controllers\User\ProfilController::class, 'profile'])->name('profile');
    Route::get('modifier-password', [\App\Http\Controllers\User\ProfilController::class, 'change_password'])->name('update_password');
    Route::post('post-modifier-password', [\App\Http\Controllers\User\ProfilController::class, 'post_change_password'])->name('post_password');
});
