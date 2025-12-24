<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\UserController;

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

Route::get('/login', function(){return view('auth.login');})->name('login');
Route::post('/',[AuthController::class, 'login_post'])->name('login.post');
Route::get('/',[ItemController::class, 'index'])->name('index');
Route::get('/item/{id}', [ItemController::class, 'show'])->name('item.show');
Route::post('/register', [AuthController::class, 'register'])->name('register');
Route::get('/sell', [ItemController::class, 'sell'])->name('sell');

Route::middleware('auth')->group(function(){
    Route::get('/mypage', [UserController::class, 'mypage'])->name('mypage');
    Route::get('/mypage/profile', [UserController::class, 'profile'])->name('profile');
    Route::post('/mypage/profile/update', [UserController::class, 'profile_update'])->name('profile.update');
    Route::get('/purchase/{id}', [ItemController::class, 'return_purchase'])->name('return.purchase');
    Route::post('/purchase/{id}', [ItemController::class, 'purchase'])->name('item.purchase');
    Route::post('/comment', [ItemController::class, 'comment'])->name('comment');
    Route::post('/sell', [ItemController::class, 'store'])->name('sell.store');
    Route::post('/item/{item_id}', [ItemController::class, 'toggleLike'])->name('item.like');
    Route::get('/purchase/address/{id}', [ItemController::class, 'address_edit'])->name('address.edit');
    Route::post('/purchase/address/{id}', [ItemController::class, 'address_update'])->name('address.update');
    Route::post('/pay', [ItemController::class, 'pay'])->name('pay');
});



