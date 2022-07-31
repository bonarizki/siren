<?php

use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\CarController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\TypeController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\User\CarController as CarUserController;
use App\Http\Controllers\User\StatusController;
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


Route::middleware(['ifauth'])->group(function () {
    Route::get('login',function(){
        return view('auth.login');
    });
    Route::get('register',function(){
        return view('auth.register');
    });
});

Route::post('login',[AuthController::class,'authenticate']);
Route::post('register',[AuthController::class,'register']);
Route::get('/', [DashboardController::class,'index']);
Route::get('logout', [AuthController::class,'logout']);
Route::post('changePass',[AuthController::class,'changePass']);
Route::post('upload-transfer',[StatusController::class,'update']);
Route::resource('status',StatusController::class)->except(['update']);

Route::middleware(['auth.admin'])->group(function(){
    Route::get('admin-dashboard', function () {
        return view('admin.dashboard');
    });
    
    Route::resource('type',TypeController::class);
    Route::resource('brand',BrandController::class);
    Route::resource('users',UserController::class);
    Route::post('cars-update',[CarController::class,'update']);
    Route::resource('cars',CarController::class)->except(['update']);
    Route::resource('orders', OrderController::class);
});

// Route::get(/)
Route::get('cars-rent',[CarUserController::class,'index']);
Route::get('cars-rent/{car}/edit',[CarUserController::class,'edit']);
Route::post('cars-rent',[CarUserController::class,'store']);
