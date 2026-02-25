<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PublicNewsController;

Route::get('/news', [PublicNewsController::class, 'index']);