<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::resources([
    'books' => BookController::class,
    'authors' => AuthorController::class,
    'users' => UserController::class
]);

Route::get('login', [UserController::class, 'login'])->name('login');
Route::post('login', [UserController::class, 'userLogin'])->name('login.user');
Route::get('registration', [UserController::class, 'registration'])->name('register-user');

Route::middleware(['auth'])->group(function () {
    Route::get('users-author', [UserController::class, 'author'])->name('author');
    Route::post('user-registration', [UserController::class, 'userRegistration'])->name('register.user');
    Route::get('signout', [UserController::class, 'signOut'])->name('signout');
});
