<?php

use App\Http\Controllers\BannerController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LogoController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SubCategoryController;
use Illuminate\Support\Facades\Route;
use Modules\Users\App\Http\Controllers\UsersController;

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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::prefix('admin')->middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');
});

Route::prefix('admin')->middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::controller(UsersController::class)->group(function () {
        Route::get('user', 'index')->name('user.index');
        Route::get('user/create', 'create')->name('user.create');
        Route::post('user/store', 'store')->name('user.store');
        Route::get('user/edit/{id}', 'edit')->name('user.edit');
        Route::post('user/update/{id}', 'update')->name('user.update');
        Route::get('user/delete/{id}', 'destroy')->name('user.destroy');
        Route::get('user/status/{id}', 'status')->name('user.status');
        Route::post('user/search', 'search')->name('user.search');
    });

    Route::controller(CategoryController::class)->group(function () {
        Route::get('category', 'index')->name('category.index');
        Route::get('category/create', 'create')->name('category.create');
        Route::post('category/store', 'store')->name('category.store');
        Route::get('category/edit/{id}', 'edit')->name('category.edit');
        Route::post('category/update/{id}', 'update')->name('category.update');
        Route::get('category/delete/{id}', 'destroy')->name('category.destroy');
        Route::post('category/status', 'status')->name('category.status');
        Route::post('category/search', 'search')->name('category.search');
    });
    Route::controller(SubCategoryController::class)->group(function () {
        Route::get('subcategory', 'index')->name('subcategory.index');
        Route::get('subcategory/create', 'create')->name('subcategory.create');
        Route::post('subcategory/store', 'store')->name('subcategory.store');
        Route::get('subcategory/edit/{id}', 'edit')->name('subcategory.edit');
        Route::post('subcategory/update/{id}', 'update')->name('subcategory.update');
        Route::get('subcategory/delete/{id}', 'destroy')->name('subcategory.destroy');
        Route::post('subcategory/status', 'status')->name('subcategory.status');
        Route::post('subcategory/search', 'search')->name('subcategory.search');
    });

    Route::controller(BannerController::class)->group(function () {
        Route::get('banner', 'index')->name('banner.index');
        Route::get('banner/create', 'create')->name('banner.create');
        Route::post('banner/store', 'store')->name('banner.store');
        Route::get('banner/edit/{id}', 'edit')->name('banner.edit');
        Route::post('banner/update/{id}', 'update')->name('banner.update');
        Route::get('banner/delete/{id}', 'destroy')->name('banner.destroy');
        Route::post('banner/status', 'status')->name('banner.status');
        Route::post('banner/search', 'search')->name('banner.search');
    });

    Route::controller(LogoController::class)->group(function () {
        Route::get('logo', 'index')->name('logo.index');
        Route::get('logo/create', 'create')->name('logo.create');
        Route::post('logo/store', 'store')->name('logo.store');
        Route::get('logo/edit/{id}', 'edit')->name('logo.edit');
        Route::post('logo/update/{id}', 'update')->name('logo.update');
        Route::get('logo/delete/{id}', 'destroy')->name('logo.destroy');
        Route::post('logo/status', 'status')->name('logo.status');
        Route::post('logo/search', 'search')->name('logo.search');
    });
});

require __DIR__ . '/auth.php';
