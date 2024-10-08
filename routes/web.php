<?php

use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\BookController;
use App\Http\Controllers\Admin\GenreController;
use App\Http\Controllers\Admin\RatingController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Middleware\AdminMiddleware;
use App\Http\Middleware\UserStatus;
use Illuminate\Support\Facades\Route;


Route::get('/',[AuthController::class,'login'])->name('login');
Route::post('login',[AuthController::class,'loginCheck'])->name('loginCheck');
Route::post('logout', [AuthController::class, 'logout'])->middleware('auth')->name('logout');

Route::middleware(['auth',AdminMiddleware::class,UserStatus::class])->prefix('admin')->group(function (){
    Route::resource('books',BookController::class);
    Route::resource('genres',GenreController::class);
    Route::resource('roles',RoleController::class);
    Route::resource('users',UserController::class);
    Route::post('post-rating',[RatingController::class,'store'])->name('store.rating');
    Route::get('/books/download/{id}', [BookController::class, 'download'])->name('books.download');

});

