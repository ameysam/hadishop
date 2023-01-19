<?php

use App\Http\Controllers\Cedar\Admin\CedarController;
use App\Http\Controllers\Comment\Admin\CommentController;
use App\Http\Controllers\Home\HomeAdminController;
use App\Http\Controllers\Role\Admin\RoleController;
use App\Http\Controllers\Search\Admin\AutoCompleteSearch;
use App\Http\Controllers\Category\Admin\CategoryController;
use App\Http\Controllers\Product\Admin\ProductController;
use App\Http\Controllers\Slider\Admin\SliderController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\Admin\UserController;
use App\Http\Controllers\User\Admin\UserRoleController;
use App\Http\Controllers\User\Profile\ProfileController;

Route::prefix('cp')->name('admin.')->group(function (){
// Route::group(['prefix' => 'cp', 'as' => 'admin.'], function () {
    // Route::get('/', function () {
    //     dd(auth()->user()->full_name);
    // });

    Route::prefix('')->name('home.')->group(function (){
        Route::get('', [HomeAdminController::class, 'index'])->name('index');
    });


    Route::prefix('comments')->name('comment.')->group(function (){
        Route::post('', [CommentController::class, 'store'])->name('store');
    });



    Route::prefix('search')->name('search.')->group(function (){
        Route::prefix('auto')->name('auto.')->group(function (){
            Route::post('users', [AutoCompleteSearch::class, 'users'])->name('user');
            Route::post('centers-rooms', [AutoCompleteSearch::class, 'centersRooms'])->name('centers-rooms');
            // Route::post('roles', [AutoCompleteSearch::class, 'roles'])->name('role');
        });
    });

    Route::prefix('roles')->name('role.')->middleware(['role:admin'])->group(function (){
        Route::get('', [RoleController::class, 'index'])->name('index');
        Route::post('items', [RoleController::class, 'items'])->name('items');
        Route::get('create', [RoleController::class, 'create'])->name('create');
        Route::post('', [RoleController::class, 'store'])->name('store');
        Route::get('{id}', [RoleController::class, 'show'])->name('show');
        Route::get('{id}/edit', [RoleController::class, 'edit'])->name('edit');
        Route::put('{id}', [RoleController::class, 'update'])->name('update');
        Route::delete('{ids}', [RoleController::class, 'delete'])->name('delete');
    });

    Route::prefix('categories')->name('category.')->group(function (){
        Route::get('', [CategoryController::class, 'index'])->name('index');
        Route::post('items', [CategoryController::class, 'items'])->name('items');
        Route::get('create', [CategoryController::class, 'create'])->name('create');
        Route::post('', [CategoryController::class, 'store'])->name('store');
        Route::get('{id}', [CategoryController::class, 'show'])->name('show');
        Route::get('{id}/edit', [CategoryController::class, 'edit'])->name('edit');
        Route::put('{id}', [CategoryController::class, 'update'])->name('update');

        Route::prefix('{ids}')->group(function (){
            Route::patch('', [CategoryController::class, 'softDelete'])->name('soft');
            Route::delete('', [CategoryController::class, 'forceDelete'])->name('force');
        });
    });

    Route::prefix('products')->name('product.')->group(function (){
        Route::get('', [ProductController::class, 'index'])->name('index');
        Route::post('items', [ProductController::class, 'items'])->name('items');
        Route::get('create', [ProductController::class, 'create'])->name('create');
        Route::post('', [ProductController::class, 'store'])->name('store');
        Route::get('{id}', [ProductController::class, 'show'])->name('show');
        Route::get('{id}/edit', [ProductController::class, 'edit'])->name('edit');
        Route::put('{id}', [ProductController::class, 'update'])->name('update');

        Route::prefix('{ids}')->group(function (){
            Route::patch('', [ProductController::class, 'softDelete'])->name('soft');
            Route::delete('', [ProductController::class, 'forceDelete'])->name('force');
        });
    });

    Route::prefix('sliders')->name('slider.')->group(function (){
        Route::get('', [SliderController::class, 'index'])->name('index');
        Route::post('items', [SliderController::class, 'items'])->name('items');
        Route::get('create', [SliderController::class, 'create'])->name('create');
        Route::post('', [SliderController::class, 'store'])->name('store');
        Route::get('{id}', [SliderController::class, 'show'])->name('show');
        Route::get('{id}/edit', [SliderController::class, 'edit'])->name('edit');
        Route::put('{id}', [SliderController::class, 'update'])->name('update');

        Route::prefix('{ids}')->group(function (){
            Route::delete('', [SliderController::class, 'forceDelete'])->name('force');
        });
    });


    Route::prefix('users')->name('user.')->middleware(['role:admin'])->group(function (){
        Route::get('', [UserController::class, 'index'])->name('index');
        Route::post('items', [UserController::class, 'items'])->name('items');
        Route::get('create', [UserController::class, 'create'])->name('create');
        Route::post('', [UserController::class, 'store'])->name('store');

        Route::prefix('{id}')->group(function (){
            Route::get('', [UserController::class, 'show'])->name('show');
            Route::get('edit', [UserController::class, 'edit'])->name('edit');
            Route::put('', [UserController::class, 'update'])->name('update');

            Route::prefix('roles')->name('role.')->group(function (){
                Route::get('', [UserRoleController::class, 'index'])->name('index');
                Route::post('items', [UserRoleController::class, 'items'])->name('items');
                Route::post('assign-roles', [UserRoleController::class, 'assignRoles'])->name('assign-role');
                Route::delete('{ids}', [UserRoleController::class, 'delete'])->name('delete');
            });
        });

        Route::prefix('{ids}')->group(function (){
            Route::post('assign-roles', [UserController::class, 'assignRoles'])->name('assign');
            Route::patch('', [UserController::class, 'softDelete'])->name('soft');
            Route::delete('', [UserController::class, 'forceDelete'])->name('force');
        });
    });

    Route::prefix('profile')->name('profile.')->group(function (){
        Route::get('', [ProfileController::class, 'edit'])->name('edit');
        Route::put('', [ProfileController::class, 'update'])->name('update');
    });

    /**
     * Section Cedar
     */
    Route::prefix('map')->name('map.')->group(function (){
        Route::prefix('cedar')->name('cedar.')->group(function (){
            Route::post('call', [CedarController::class, 'direction'])->name('call.url');
        });
    });
});


