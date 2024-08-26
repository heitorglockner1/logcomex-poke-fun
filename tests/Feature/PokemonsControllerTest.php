<?php

namespace Tests\Feature;

use App\Models\Pokemon;
use App\Models\Type;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PokemonsControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_can_list_pokemons()
    {
        Pokemon::factory()->count(15)->create();

        $response = $this->getJson(route('pokemons.index'));

        $response->assertStatus(200)
            ->assertJsonStructure([
                'data' => [
                    '*' => [
                        'id',
                        'name',
                        'height',
                        'weight',
                        'types'
                    ]
                ],
                'links',
                'meta'
            ]);
    }

    public function test_it_can_show_a_pokemon()
    {
        $pokemon = Pokemon::factory()->create();

        $response = $this->getJson(route('pokemons.show', $pokemon->id));

        $response->assertStatus(200)
            ->assertJson([
                'data' => [
                    'id' => $pokemon->id,
                    'name' => $pokemon->name,
                    'height' => $pokemon->height * 100,
                    'weight' => $pokemon->weight / 1000,
                ]
            ]);
    }

    public function test_it_can_filter_pokemons_by_name()
    {
        Pokemon::factory()->create(['name' => 'Pikachu']);
        Pokemon::factory()->create(['name' => 'Charmander']);

        $response = $this->getJson(route('pokemons.index', ['name' => 'Pikachu']));

        $response->assertStatus(200)
            ->assertJsonCount(1, 'data')
            ->assertJson([
                'data' => [
                    [
                        'name' => 'Pikachu'
                    ]
                ]
            ]);
    }

    public function test_it_can_filter_pokemons_by_type()
    {
        $electricType = Type::factory()->create(['name' => 'Electric']);
        $pokemon = Pokemon::factory()->create(['name' => 'Pikachu']);
        $pokemon->types()->attach($electricType->id);

        $response = $this->getJson(route('pokemons.index', ['types' => [$electricType->id]]));

        $response->assertStatus(200)
            ->assertJsonCount(1, 'data')
            ->assertJson([
                'data' => [
                    [
                        'name' => 'Pikachu'
                    ]
                ]
            ]);
    }
}
