<?php

use App\Enums\AuthGuard;
use App\Http\Controllers\v1\AuthController;
use App\Http\Controllers\v1\ConstantController;
use App\Http\Controllers\v1\ContentController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'auth', 'as' => 'auth.'], function () {
    Route::post('login', [AuthController::class, 'login']);
    Route::post('register', [AuthController::class, 'register']);
});

Route::group(['prefix' => 'config', 'as' => 'config.'], function () {
    Route::get('constants', [ConstantController::class, 'index']);
});

Route::group(['prefix' => 'content', 'as' => 'content.'], function () {
    Route::get('/{type}', [ContentController::class, 'show']);
});

Route::middleware(['auth:sanctum'])->group(function () {
    Route::apiResource('profile', AuthController::class)->only(['index']);
});