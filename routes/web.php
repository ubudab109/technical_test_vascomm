<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BannerController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
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

Route::get('login-view',[AuthController::class, 'loginView'])->name('login.view');
Route::get('register-view',[AuthController::class, 'registerView'])->name('register.view');
Route::post('login',[AuthController::class, 'loginProcess'])->name('login');
Route::post('register',[AuthController::class, 'register'])->name('register');
Route::post('logout',[AuthController::class, 'logout'])->name('logout');
;
Route::get('/',[HomeController::class, 'index'])->name('home');

Route::group(['middleware' => ['admin_auth']], function() {
    Route::group(['prefix' => 'users'], function() {
        Route::get('',[UserController::class, 'index'])->name('users.index');
        Route::get('{id}',[UserController::class, 'detail'])->name('users.detail');
        Route::put('{id}',[UserController::class, 'update'])->name('users.update');
        Route::delete('{id}',[UserController::class, 'reject'])->name('users.delete');
    });

    Route::group(['prefix' => 'product'], function() {
        Route::get('',[ProductController::class, 'index'])->name('product.index');
        Route::post('',[ProductController::class, 'store'])->name('product.store');
        Route::delete('{id}',[ProductController::class, 'delete'])->name('product.delete');
    });

    Route::group(['prefix' => 'banners'], function() {
        Route::get('',[BannerController::class, 'index'])->name('banners.index');
        Route::post('',[BannerController::class, 'store'])->name('banners.store');
        Route::delete('{id}',[BannerController::class, 'delete'])->name('banners.delete');
    });
});
