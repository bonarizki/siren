<?php

use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\CarController;
use App\Http\Controllers\Admin\TypeController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\User\CarController as CarUserController;
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

Route::get('/', [DashboardController::class,'index']);

Route::get('admin-dashboard', function () {
    return view('admin.dashboard');
});
Route::resource('type',TypeController::class);
Route::resource('brand',BrandController::class);
Route::resource('user',UserController::class);
Route::post('cars-update',[CarController::class,'update']);
Route::resource('cars',CarController::class)->except(['update']);

// Route::get(/)
Route::get('cars-rent',[CarUserController::class,'index']);
