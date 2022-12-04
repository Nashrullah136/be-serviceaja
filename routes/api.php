<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CatalogController;
use App\Http\Controllers\MotorController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\SparepartController;
use App\Models\Shop;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


Route::controller(ShopController::class)->group(function () {
    Route::get('/shops', 'index');
    Route::get('/shops/{shop}', 'show');
});

Route::controller(NewsController::class)->group(function () {
    Route::get('/news', 'index');
    Route::get('/news/{news}', 'show');
});

Route::controller(CatalogController::class)->group(function () {
    Route::get('/catalogs', 'index');
    Route::get('/catalogs/{catalog}', 'show');
});

Route::controller(AuthController::class)->group(function () {
    Route::post('/register', 'register');
    Route::post('/login', 'login');
    Route::delete('/logout', 'logout')->middleware('auth:sanctum');
    Route::get('/user', 'user')->middleware('auth:sanctum');
});

Route::controller(MotorController::class)->middleware('auth:sanctum')->group(function () {
    Route::get('/motors', 'index');
    Route::get('/motors/{motor}', 'show');
    Route::get('/motors/{motor}/schedule', 'schedule');
    Route::post('/motors', 'store');
    Route::put('/motors/{motor}', 'update');
    Route::put('/schedules/{schedule}', 'updateSchedule');
    Route::delete('/motors/{motor}', 'destroy');
});

Route::controller(ServiceController::class)->middleware('auth:sanctum')->group(function (){
    Route::get('/services', 'index');
    Route::post('/services', 'store');
});

Route::middleware(['auth:sanctum', 'admin'])->group(function(){
    // Route::controller(SparepartController::class)->group(function(){
    //     Route::get('/spareparts', 'index');
    //     Route::get('/spareparts/{sparepart}', 'show');
    //     Route::post('/spareparts', 'store');
    //     Route::put('/spareparts/{sparepart}', 'update');
    //     Route::delete('/spareparts/{sparepart}', 'destroy');
    // });
    Route::controller(CatalogController::class)->group(function () {
        Route::post('/catalogs', 'store');
        Route::put('/catalogs/{catalog}', 'update');
        Route::delete('/catalogs/{catalog}', 'destroy');
    });
    Route::controller(NewsController::class)->group(function () {
        Route::post('/news', 'store');
        Route::put('/news/{news}', 'update');
        Route::delete('/news/{news}', 'destroy');
    });
    Route::controller(ShopController::class)->group(function () {
        Route::post('/shops', 'store');
        Route::put('/shops/{shop}', 'update');
        Route::delete('/shops/{shop}', 'destroy');
    });
});
