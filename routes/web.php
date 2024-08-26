<?php

use Illuminate\Support\Facades\Route;

Route::get('/', fn () => view('app'))->name('application');
Route::get('/pokemons/{id}', fn () => view('app'))->name('application');
