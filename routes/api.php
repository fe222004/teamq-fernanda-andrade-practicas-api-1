<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\MovieActorController;
use App\Http\Controllers\MovieController;
use App\Http\Controllers\MovieRentController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware('auth:sanctum')->group(function () {
    
    Route::get('/movies', [\App\Http\Controllers\MovieController::class, 'index']);
    Route::get('/movies/{movie}', [\App\Http\Controllers\MovieController::class, 'show']);
    Route::post('/movies', [\App\Http\Controllers\MovieController::class, 'store']);
    Route::put('/movies/{movie}', [\App\Http\Controllers\MovieController::class, 'update']);
    Route::delete('/movie/{movie}', [\App\Http\Controllers\MovieController::class, 'destroy']);

    Route::get('/actors', [\App\Http\Controllers\ActorController::class, 'index']);
    Route::get('/actors/{actor}', [\App\Http\Controllers\ActorController::class, 'show']);
    Route::post('/actors', [\App\Http\Controllers\ActorController::class, 'store']);
    Route::put('/actors/{actor}', [\App\Http\Controllers\ActorController::class, 'update']);
    Route::delete('/actors/{actor}', [\App\Http\Controllers\ActorController::class, 'destroy']);

    Route::get('/directors', [\App\Http\Controllers\DirectorController::class, 'index']);
    Route::get('/directors/{director}', [\App\Http\Controllers\DirectorController::class, 'show']);
    Route::post('/directors', [\App\Http\Controllers\DirectorController::class, 'store']);
    Route::put('/directors/{director}', [\App\Http\Controllers\DirectorController::class, 'update']);
    Route::delete('/directors/{director}', [\App\Http\Controllers\DirectorController::class, 'destroy']);

    Route::get('/rents', [\App\Http\Controllers\RentController::class, 'index']);
    Route::get('/rents/{rent}', [\App\Http\Controllers\RentController::class, 'show']);
    Route::post('/rents', [\App\Http\Controllers\RentController::class, 'store']);
    Route::put('/rents/{rent}', [\App\Http\Controllers\RentController::class, 'update']);
    Route::delete('/rents/{rent}', [\App\Http\Controllers\RentController::class, 'destroy']);

    Route::get('movies/{movie}/actors', [MovieActorController::class, 'actors']);
    Route::post('movies/{movie}/actors', [MovieActorController::class, 'add']);
    Route::delete('movies/{movie}/actors', [MovieActorController::class, 'remove']);

    Route::get('movies/{movie}/rents', [\App\Http\Controllers\MovieRentController::class, 'rent']);
    Route::post('movies/{movie}/rents', [MovieRentController::class, 'add']);
    Route::delete('movies/{movie}/rents', [MovieRentController::class, 'remove']);

    Route::get('/users', [AuthController::class, 'users']);
    Route::get('/user/{user}', [\App\Http\Controllers\UserController::class, 'show']);
    Route::put('/auth/{user}', [AuthController::class, 'update']);
    Route::delete('/auth/{user}', [AuthController::class, 'destroy']);

    Route::apiResource('movies/{movie}/images',\App\Http\Controllers\ImageController::class);
});

Route::post('auth',[AuthController::class,'login']);
Route::post('register',[AuthController::class,'register']);




