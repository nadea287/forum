<?php

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
Route::post('/comment/create/{thread}', [\App\Http\Controllers\CommentController::class, 'store'])->name('comment.store');
Route::post('/comment/reply/{comment}', [\App\Http\Controllers\CommentController::class, 'replyToComment'])->name('reply.store');
//Route::post('/comment/{comment}', [\App\Http\Controllers\CommentController::class, 'destroy'])->name('comment.store');
Route::get('/markAsRead', [\App\Http\Controllers\CommentController::class, 'markAsRead']);

//MARK AS SOLUTION
Route::post('/flag/{type}/{target}', [\App\Http\Controllers\FlagController::class, 'setFlag']);
Route::get('/api/solution/{comment}', [\App\Http\Controllers\FlagController::class, 'getFlag']);

Route::get('/profile/{user}', [\App\Http\Controllers\ProfileController::class, 'show'])->name('profile.show');
Route::get('/profile/{user}/edit', [\App\Http\Controllers\ProfileController::class, 'edit'])->name('profile.edit');
Route::put('/profile/{user}', [\App\Http\Controllers\ProfileController::class, 'update'])->name('profile.update');

Route::view('/blog/index', 'blog/index');
Route::view('/blog/first', 'blog/first');
Route::view('/blog/second', 'blog/second');
Route::view('/blog/third', 'blog/third');
Route::view('/blog/stripe-menu', 'blog/stripe-menu');
