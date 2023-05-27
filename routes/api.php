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

Route::get('/actor/{actor}/movie', [GenreController::class, 'movies_actors']);

Route::post('/movie', [MoiveController::class, 'index']);

Route::get('/movie/{movie}/images', [MoiveController::class, 'images']);

Route::get('/movie/{movie}/actors', [MoiveController::class, 'actors']);

Route::get('/movie/{movie}/related_movie', [MoiveController::class, 'related_movie']);


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
