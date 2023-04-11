<?php

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
Route::post('/admin/register',[\App\Http\Controllers\AuthController::class, 'register'])->name('register');
Route::post('/login', [\App\Http\Controllers\AuthController::class, 'login'])->name('login');
Route::middleware('checkRole:admin-api')->group(function () {
    Route::post('/logout', [\App\Http\Controllers\AuthController::class, 'logout'])->name('logout');

    ////////////////////////// Cities ///////////////////////////
    Route::get('/cities',[\App\Http\Controllers\Admin\CityController::class, 'getAllCities']);
    Route::post('/city/by_id',[\App\Http\Controllers\Admin\CityController::class, 'getCityById']);
    Route::post('/city',[\App\Http\Controllers\Admin\CityController::class, 'storeCity']);
    Route::post('/city/delete',[\App\Http\Controllers\Admin\CityController::class, 'deleteCity']);
    Route::post('/city/update',[\App\Http\Controllers\Admin\CityController::class, 'updateCity']);
///////////////////////////// End Of Cities ///////////////////
///
//////////////////////////// Regions //////////////////////////
    Route::get('/regions',[\App\Http\Controllers\Admin\RegionController::class, 'getAllRegions']);
    Route::post('/region/by_id',[\App\Http\Controllers\Admin\RegionController::class, 'getRegionById']);
    Route::post('/region',[\App\Http\Controllers\Admin\RegionController::class, 'storeRegion']);
    Route::post('/region/delete',[\App\Http\Controllers\Admin\RegionController::class, 'deleteRegion']);
    Route::post('/region/update',[\App\Http\Controllers\Admin\RegionController::class, 'updateRegion']);
/////////////////////////////// End Of Regions ///////////////////
});


Route::middleware('checkRole:marketManager-api')->group(function () {//this is for user
    Route::controller(\App\Http\Controllers\Market\Controller\MarketController::class)->group(function () {
        Route::get('getAllFactory', 'getAllFactory');
        Route::get('getAllAds', 'getAllAds');
        Route::get('getProductToHomePage', 'getProductToHomePage');
        Route::post('searchFactoryByName', 'searchFactoryByName');
        Route::post('getOfferForFactory', 'getOfferForFactory');
        Route::post('getAllCategoryForFactory', 'getAllCategoryForFactory');
        Route::post('getAllSubCategoryForFactory', 'getAllSubCategoryForFactory');
        Route::post('getAllProductForSubCategory', 'getAllProductForSubCategory');
        Route::post('createOrder', 'createOrder');
        Route::post('getWaitAcceptOrder', 'getWaitAcceptOrder');
        Route::post('getRejectCompleteOrder', 'getRejectCompleteOrder');
    });
});
