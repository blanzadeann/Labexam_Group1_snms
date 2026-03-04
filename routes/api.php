<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\PublicArticleController;

// Public Routes
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::get('/articles/public', [PublicArticleController::class, 'index']);
Route::get('/articles/search', [ArticleController::class, 'search']);

// Protected Routes
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    Route::post('/logout', [AuthController::class, 'logout']);
    Route::patch('/articles/{article}/publish', [ArticleController::class, 'publish']);
    
    Route::apiResource('articles', ArticleController::class);
    Route::apiResource('categories', CategoryController::class);
});