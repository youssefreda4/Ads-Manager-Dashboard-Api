<?php

use App\Models\District;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Request;
use PhpParser\Node\Scalar\MagicConst\Dir;
use App\Http\Controllers\Api\V1\Dashboard\AdController;
use App\Http\Controllers\Api\V1\Dashboard\CityController;
use App\Http\Controllers\Api\V1\Dashboard\MessageController;
use App\Http\Controllers\Api\V1\Dashboard\SettingController;
use App\Http\Controllers\Api\V1\Dashboard\CategoryController;
use App\Http\Controllers\Api\V1\Dashboard\DistrictController;

Route::get('/user', function (Request $request) {
    return request()->user();
})->middleware('auth:sanctum');

Route::prefix('dashboard')->name('dashboard.')->group(function () {

    Route::apiResource('settings', SettingController::class);

    Route::apiResource('cities', CityController::class);

    Route::apiResource('districts', DistrictController::class);

    Route::apiResource('messages', MessageController::class);

    Route::apiResource('categories', CategoryController::class);

    Route::controller(AdController::class)->group(function () {
        Route::prefix('ads')->name('ads.')->group(function () {
            Route::get('latest', 'latest')->name('latest');
            Route::get('category/{category}', 'category')->name('category');
            Route::get('search', 'search')->name('search');
            Route::get('/', 'index')->name('index');

            Route::middleware(['auth:sanctum'])->group(function () {
                Route::get('myads', 'myAds')->name('myads');
                Route::post('/', 'store')->name('store');
                Route::put('{ad}', 'update')->name('update');
                Route::delete('{ad}', 'destroy')->name('destroy');
            });
        });
    });


    require_once(__DIR__ . '/auth.php');
});
