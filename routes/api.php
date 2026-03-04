<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\ArticleController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    
    // Developer 7: Publish article feature endpoint
    // We use PATCH because we are only updating the 'status' field
    Route::patch('/articles/{article}/publish', [ArticleController::class, 'publish']);
});

// Developer 6: Article CRUD API
Route::apiResource('articles', ArticleController::class);