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

Route::get('get-counts',[HomeController::class,'getCounts']);
Route::get('most-rated',[HomeController::class,'mostRated']);
Route::get('most-rated-readers',[HomeController::class,'mostRatedReaders']);
// books
Route::get('books',[BookController::class,'index'])->name('books.index');
Route::get('books/{id}',[BookController::class,'show'])->name('books.show');
// genres
Route::get('genres',[GenreController::class,'index'])->name('genres.index');
Route::get('genres/{id}',[GenreController::class,'show'])->name('genres.show');
// ratings
Route::get('ratings',[RatingController::class,'index'])->name('ratings.index');
Route::get('ratings/{id}',[RatingController::class,'show'])->name('ratings.show');
// roles
Route::get('roles',[RoleController::class,'index'])->name('roles.index');
Route::get('roles/{id}',[RoleController::class,'show'])->name('roles.show');


Route::middleware('auth:sanctum')->group(function (){
    // Books
    Route::post('books',[BookController::class,'store'])->name('books.store');
    Route::put('books/{id}',[BookController::class,'update'])->name('books.update');
    Route::delete('books/{id}',[BookController::class,'destroy'])->name('books.destroy');
    // Genre
    Route::post('genres',[GenreController::class,'store'])->name('genres.store');
    Route::put('genres/{id}',[GenreController::class,'update'])->name('genres.update');
    Route::delete('genres/{id}',[GenreController::class,'destroy'])->name('genres.destroy');
    // ratings
    Route::post('ratings',[RatingController::class,'store'])->name('ratings.store');
    Route::put('ratings/{id}',[RatingController::class,'update'])->name('ratings.update');
    Route::delete('ratings/{id}',[RatingController::class,'destroy'])->name('ratings.destroy');
    // ratings
    Route::post('roles',[RoleController::class,'store'])->name('roles.store');
    Route::put('roles/{id}',[RoleController::class,'update'])->name('roles.update');
    Route::delete('roles/{id}',[RoleController::class,'destroy'])->name('roles.destroy');


//    Route::apiResource('roles',RoleController::class);
//    Route::apiResource('books',BookController::class);
//    Route::apiResource('genres',GenreController::class);
//    Route::apiResource('ratings',RatingController::class);
});







