<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::prefix('categories')->group(function () {
    Route::get('/', [CategoryController::class, 'index']);           
    Route::post('/', [CategoryController::class, 'store']);           
    Route::get('{category}', [CategoryController::class, 'show']);     
    Route::put('{category}', [CategoryController::class, 'update']);   
    Route::patch('{category}', [CategoryController::class, 'update']);  
    Route::delete('{category}', [CategoryController::class, 'destroy']); 
});
