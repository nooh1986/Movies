<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ActorController;
use App\Http\Controllers\GenreController;
use App\Http\Controllers\MovieController;
use App\Http\Controllers\ProfileController;



Route::get('/', function () { return view('auth.login'); })->name('log');


Route::group(['middleware' => 'auth'],function()
{
    //home
    Route::get('/dashboard', [HomeController::class, 'home'])->name('home');
    Route::get('/statistics', [HomeController::class, 'statistics'])->name('statistics');

    //users routes
    Route::get('/users/data', [UserController::class, 'data'])->name('users.data');
    Route::delete('/users/bulk_delete', [UserController::class , 'bulkDelete'])->name('users.bulk_delete');
    Route::resource('users', UserController::class);

    //genre routes
    Route::get('/genres/data', [GenreController::class, 'data'])->name('genres.data');
    Route::delete('/genres/bulk_delete', [GenreController::class , 'bulkDelete'])->name('genres.bulk_delete');
    Route::resource('genres', GenreController::class)->only(['index', 'destroy']);

    //movie routes
    Route::get('/movies/data', [MovieController::class, 'data'])->name('movies.data');
    Route::delete('/movies/bulk_delete', [MovieController::class , 'bulkDelete'])->name('movies.bulk_delete');
    Route::resource('movies', MovieController::class)->only(['index', 'destroy' , 'show']);

    //actor routes
    Route::get('/actores/data', [ActorController::class, 'data'])->name('actores.data');
    Route::delete('/actores/bulk_delete', [ActorController::class , 'bulkDelete'])->name('actores.bulk_delete');
    Route::resource('actores', ActorController::class)->only(['index', 'destroy']);
    
});



Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


require __DIR__.'/auth.php';
