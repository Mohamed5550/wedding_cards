<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CountryController;
use App\Http\Controllers\FeatureController;
use App\Http\Controllers\HomeImageController;

Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();
});


Route::get('/countries', [CountryController::class, 'index']);
Route::get('/home-images', [HomeImageController::class, 'index']);
Route::get('/features', [FeatureController::class, 'index']);

require __DIR__.'/auth.php';