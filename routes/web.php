<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\HomeController;

Route::get('/', [HomeController::class, 'index']);

Route::resources([
    'books' => BookController::class,
    'authors' => AuthorController::class,
]);
Route::controller(BookController::class)->group(function () {
    Route::get('autocomplete', 'autocomplete')->name('autocomplete');
});
