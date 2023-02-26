<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Home\HomeFrontController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\Product\Front\ProductController;
use App\Http\Controllers\Category\Front\CategoryController;
use App\Http\Controllers\Province\Admin\ProvinceController;
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

Route::prefix('')->name('front.')->group(function (){
    Route::prefix('')->name('home.')->group(function (){
        Route::get('', [HomeFrontController::class, 'index'])->name('index');
    });

    Route::prefix('products')->name('product.')->group(function (){
        Route::get('', [ProductController::class, 'index'])->name('index');
        Route::get('{id}/{title?}', [ProductController::class, 'show'])->name('show');
    });

    Route::prefix('categories')->name('category.')->group(function (){
        Route::get('{id}/{title?}', [CategoryController::class, 'show'])->name('show');
    });



});

Route::prefix('provinces')->name('province.')->group(function (){
    Route::get('', [ProvinceController::class, 'index'])->name('index');
    Route::get('provinces', [ProvinceController::class, 'provinces'])->name('provinces');
    Route::get('{id}/cities', [ProvinceController::class, 'cities'])->name('cities');
});

Route::prefix('login')->name('login.')->group(function (){
    Route::get('', [LoginController::class, 'showLoginForm'])->name('index');
    Route::post('', [LoginController::class, 'authenticate'])->name('action');
});
Route::prefix('register')->name('register.')->group(function (){
    Route::get('', [RegisterController::class, 'create'])->name('create');
    Route::post('', [RegisterController::class, 'store'])->name('store');
    Route::get('activation/{activation_token}', [RegisterController::class, 'activationByEmail'])->name('activation');
});
Route::get('message', [MessageController::class, 'message'])->name('message');
Route::any('logout', [LoginController::class, 'logout'])->name('logout');
