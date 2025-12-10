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

Route::post('/',[AuthController::class, 'login'])->name('login');
Route::get('/',[ItemController::class, 'index']);
Route::get('/item/{id}', [ItemController::class, 'show'])->name('item.show');
Route::post('/purchase', [ItemController::class, 'purchase'])->name('item.purchase');
Route::post('/mypage/profile', [AuthController::class, 'register'])->name('register');
Route::get('/profile', [UserController::class, 'profile'])->name('profile');
Route::get('/list', [ItemController::class, 'list'])->name('list');
Route::post('/item/{item_id}', [ItemController::class, 'toggleLike'])->name('item.like');
/*Route::post('/', [UserController::class, 'profile_update'])->name('profile.update');*/
