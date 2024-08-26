<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PokemonsController;
use App\Http\Controllers\TypesController;

Route::prefix('pokemons')->group(function () {
    Route::get('/', [PokemonsController::class, 'index'])->name('pokemons.index');
    Route::get('/{pokemon}', [PokemonsController::class, 'show'])->name('pokemons.show');
});

Route::get('/types', TypesController::class)->name('types.index');
