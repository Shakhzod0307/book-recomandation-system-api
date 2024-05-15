<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\GenreController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RatingController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserInterestController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::post('login',[AuthController::class,'login']);
Route::post('register',[AuthController::class,'register']);
Route::post('logout',[AuthController::class, 'logout'])->middleware('auth:sanctum');

Route::middleware('auth:sanctum')->group(function (){
    Route::get('get-counts',[HomeController::class,'getCounts']);
    Route::get('most-rated',[HomeController::class,'mostRated']);
    Route::get('most-rated-readers',[HomeController::class,'mostRatedReaders']);
    Route::apiResource('roles',RoleController::class);
    Route::apiResource('books',BookController::class);
    Route::apiResource('genres',GenreController::class);
    Route::apiResource('ratings',RatingController::class);
});






