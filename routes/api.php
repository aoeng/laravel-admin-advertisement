<?php


use Illuminate\Support\Facades\Route;

Route::prefix('api')->middleware('api')->group(function () {
    Route::get('advertisements', [Aoeng\Laravel\Admin\Advertisement\Http\Controllers\AdvertisementController::class, 'index']);
    Route::get('advertisements/show', [Aoeng\Laravel\Admin\Advertisement\Http\Controllers\AdvertisementController::class, 'show']);
});
