<?php

Route::resource('advertisements', Aoeng\Laravel\Admin\Advertisement\Admin\Controllers\AdvertisementController::class);
Route::resource('advertisement-types', Aoeng\Laravel\Admin\Advertisement\Admin\Controllers\AdvertisementTypeController::class);
