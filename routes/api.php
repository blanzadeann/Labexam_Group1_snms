<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\CategoryController;

Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    Route::post('/logout', [AuthController::class, 'logout']);
    
    // Developer 7: Publish route
    Route::patch('/articles/{article}/publish', [ArticleController::class, 'publish']);
    
    // Developer 6: Full CRUD
    // This handles GET, POST, PUT, DELETE for /api/articles
    Route::apiResource('articles', ArticleController::class);

    Route::apiResource('categories', CategoryController::class);
});

// Optional: If you want search to be public
Route::get('/articles/search', [ArticleController::class, 'search']);