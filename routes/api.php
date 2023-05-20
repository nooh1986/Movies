<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\GenreController;
use App\Http\Controllers\Api\MoiveController;



Route::post('/login', [AuthController::class, 'login']);

Route::post('/register', [AuthController::class, 'register']);

Route::post('/genre', [GenreController::class, 'index']);

Route::get('/genre/{genre}/movie', [GenreController::class, 'movies']);

Route::post('/moive', [MoiveController::class, 'index']);

Route::get('/moive/{movie}/images', [MoiveController::class, 'images']);

Route::get('/moive/{movie}/actors', [MoiveController::class, 'actors']);

Route::get('/moive/{movie}/related_movie', [MoiveController::class, 'related_movie']);


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
