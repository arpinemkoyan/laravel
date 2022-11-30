<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;

Route::get('/', [HomeController::class, 'index']);


Route::resources([
    'books' => BookController::class,
    'authors' => AuthorController::class,
    'users' => UserController::class
]);
Route::controller(BookController::class)->group(function () {
    Route::get('autocomplete', 'autocomplete')->name('autocomplete');
});

Route::get('login', [UserController::class, 'login'])->name('login');
Route::post('user-login', [UserController::class, 'userLogin'])->name('login.user');
Route::get('users-author', [UserController::class, 'author'])->name('author');
Route::get('registration', [UserController::class, 'registration'])->name('register-user');
Route::post('user-registration', [UserController::class, 'userRegistration'])->name('register.user');
Route::get('signout', [UserController::class, 'signOut'])->name('signout');
