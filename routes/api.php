<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\Api\ArticleStatsController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

route::post('/login', [AuthController::class, 'login']);

route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);

    // Dev11 - Article Statistics Endpoint
    Route::get('/articles/stats', [ArticleStatsController::class, 'index']);
});

Route::apiResource('articles', ArticleController::class);