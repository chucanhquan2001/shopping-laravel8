<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\SliderController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\SettingController;
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

Route::group(['prefix' => 'admin', 'middleware' => 'auth'], function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    // logout 
    Route::get('/logout', [AdminController::class, 'logout'])->name('logout-admin');
    Route::resource('category', CategoryController::class);
    Route::resource('menu', MenuController::class);
    Route::resource('slider', SliderController::class);
    Route::resource('setting', SettingController::class);
});

// login quản trị
Route::get('admin/login', [AdminController::class, 'login'])->name('login-admin');
Route::post('admin/login', [AdminController::class, 'loginPost'])->name('login-admin');

// file manager
Route::group(['prefix' => 'laravel-filemanager', 'middleware' => ['web', 'auth']], function () {
    \UniSharp\LaravelFilemanager\Lfm::routes();
});