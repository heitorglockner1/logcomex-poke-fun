<?php

namespace App\Http\Controllers;

use App\Http\Resources\TypeResource;
use App\Models\Type;
use App\Services\PokemonsService;

class TypesController extends Controller
{
    public function __invoke(PokemonsService $pokemonsService)
    {
        $types = Type::orderBy('name', 'ASC')->get();

        return TypeResource::collection($types);
    }
}
