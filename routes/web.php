<?php

use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Route;

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
//    return view('welcome');
    return view('blog.index');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::resource('thread', \App\Http\Controllers\ThreadController::class);

Route::group(['prefix' => 'comment'], function () {
    Route::post('create/{thread}', [\App\Http\Controllers\CommentController::class, 'store'])->name('comment.store');
    Route::post('reply/{comment}', [\App\Http\Controllers\CommentController::class, 'replyToComment'])->name('reply.store');
//Route::post('{comment}', [\App\Http\Controllers\CommentController::class, 'destroy'])->name('comment.store');
    Route::put('{comment}', [\App\Http\Controllers\CommentController::class, 'update'])->name('comment.update');
    Route::delete('{comment}', [\App\Http\Controllers\CommentController::class, 'destroy'])->name('comment.destroy');
});


Route::get('/markAsRead', [\App\Http\Controllers\CommentController::class, 'markAsRead']);

//MARK AS SOLUTION
Route::post('/flag/{type}/{target}/{ajax?}', [\App\Http\Controllers\FlagController::class, 'setFlag']);
//Route::get('/api/solution/{comment}', [\App\Http\Controllers\FlagController::class, 'getFlag']);

Route::group(['prefix' => 'profile'], function () {
    Route::get('{user}', [\App\Http\Controllers\ProfileController::class, 'show'])->name('profile.show');
    Route::get('{user}/edit', [\App\Http\Controllers\ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('{user}', [\App\Http\Controllers\ProfileController::class, 'update'])->name('profile.update');
});

//SEARCH
Route::get('/search', [\App\Http\Controllers\SearchController::class, 'search']);
Route::get('/products/search', [\App\Http\Controllers\SearchController::class, 'productSearch'])->name('product.search');

//products
Route::resource('products', \App\Http\Controllers\ProductController::class);

Route::get('products/{product}-{slug}', [\App\Http\Controllers\ProductController::class, 'show'])->name('products.show');



Route::get('/landing', [\App\Http\Controllers\LandingController::class, 'index'])->name('products.landing');
Route::resource('/cart', \App\Http\Controllers\CartController::class);
Route::post('/cart/switch-to-save-for-later/{product}', [\App\Http\Controllers\CartController::class, 'switchToSaveForLater'])->name('cart.switchToSaveForLater');

Route::group(['prefix' => 'save-for-later'], function () {
    Route::delete('{product}', [\App\Http\Controllers\SaveForLaterCntroller::class, 'destroy'])->name('saveForLater.destroy');
    Route::post('switch-to-cart/{product}', [\App\Http\Controllers\SaveForLaterCntroller::class, 'moveToCart'])->name('switchForLater.moveToCart');
});

Route::get('/checkout', [\App\Http\Controllers\CheckoutController::class, 'index'])->name('checkout.index')->middleware('auth');
Route::post('/checkout', [\App\Http\Controllers\CheckoutController::class, 'store'])->name('checkout.store');
Route::delete('/checkout', [\App\Http\Controllers\CheckoutController::class, 'destroy'])->name('checkout.destroy');

Route::get('/guestCheckout', [\App\Http\Controllers\CheckoutController::class, 'index'])->name('guestCheckout.index');

//coupon
Route::post('/coupon', [\App\Http\Controllers\CouponsController::class, 'store'])->name('coupon.store');
Route::delete('/coupon', [\App\Http\Controllers\CouponsController::class, 'destroy'])->name('coupon.destroy');

Route::get('/thankyou', [\App\Http\Controllers\ConfirmationController::class, 'index'])->name('confirmation.index');

Route::get('/empty', function () {
    Cart::instance('saveForLater')->destroy();
});



Route::view('/blog/index', 'blog/index');
Route::view('/blog/first', 'blog/first');
Route::view('/blog/second', 'blog/second');
Route::view('/blog/third', 'blog/third');
Route::view('/blog/stripe-menu', 'blog/stripe-menu');

