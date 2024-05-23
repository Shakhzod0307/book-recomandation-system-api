<?php

use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\BookController;
use App\Http\Controllers\Admin\GenreController;
use Illuminate\Support\Facades\Route;


Route::get('/',[AuthController::class,'login'])->name('login');
Route::post('login',[AuthController::class,'loginCheck'])->name('loginCheck');
Route::post('logout', [AuthController::class, 'logout'])->middleware('auth')->name('logout');

Route::prefix('admin')->group(function (){
    Route::resource('books',BookController::class);
    Route::resource('genres',GenreController::class);
})->middleware('auth');

