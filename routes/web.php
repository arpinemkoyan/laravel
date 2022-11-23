<?php

use Illuminate\Support\Facades\Route;

use App\Http\Livewire\Select2Dropdown;


Route::get('/', Select2Dropdown::class);

//Route::get('/','App\Http\Controllers\HomeController@index');

Route::resources([
    'books' => 'App\Http\Controllers\BooksController',
    'authors' => 'App\Http\Controllers\AuthorsController',
]);

