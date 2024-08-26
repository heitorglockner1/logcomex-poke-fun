<?php

namespace App\Http\Controllers;

use App\Http\Requests\PokemonsRequest;
use App\Http\Resources\PokemonResource;
use App\Models\Pokemon;
use App\Services\PokemonsService;

class PokemonsController extends Controller
{
    public function index(PokemonsRequest $request)
    {
        $pokemons = app(PokemonsService::class)
            ->list($request->validated())
            ->paginate(10);

        return PokemonResource::collection($pokemons);
    }

    public function show(Pokemon $pokemon)
    {
        return new PokemonResource($pokemon);
    }
}
