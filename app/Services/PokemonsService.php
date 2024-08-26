<?php
namespace App\Services;

use App\Models\Pokemon;
use Illuminate\Database\Eloquent\Builder;

class PokemonsService
{
    public function list(array $filter): Builder
    {
        return Pokemon::select('pokemons.*')
            ->leftJoin('pokemon_type', 'pokemon_type.pokemon_id', 'pokemons.id')
            ->when(! empty($filter['name']), fn ($query) => $query
                ->where('name', 'LIKE', "%{$filter['name']}%")
            )->when(! empty($filter['types']), fn ($query) => $query
                ->whereIn('pokemon_type.type_id', $filter['types'])
            )
            ->orderBy('name', 'ASC')
            ->groupBy('pokemons.id');
    }
}
