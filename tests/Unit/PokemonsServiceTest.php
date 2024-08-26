<?php

namespace Tests\Unit;

use App\Models\Pokemon;
use App\Models\Type;
use App\Services\PokemonsService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

class PokemonsServiceTest extends TestCase
{
    use RefreshDatabase;

    protected PokemonsService $service;

    protected function setUp(): void
    {
        parent::setUp();
        $this->service = new PokemonsService();

        Pokemon::factory()->create(['name' => 'Bulbasaur']);
        Pokemon::factory()->create(['name' => 'Charmander']);
        Pokemon::factory()->create(['name' => 'Squirtle']);
    }

    public function test_it_can_filter_pokemons_by_name()
    {
        $filter = ['name' => 'Bulbasaur'];

        $result = $this->service->list($filter)->get();

        $this->assertCount(1, $result);
        $this->assertEquals('Bulbasaur', $result->first()->name);
    }

    public function test_it_can_filter_pokemons_by_type()
    {
        Type::factory()->create(['name' => 'Electric']);
        $pokemon = Pokemon::factory()->create(['name' => 'Pikachu']);

        $typeId = DB::table('types')
            ->where('name', 'Electric')
            ->first()
            ->id;
        $pokemon->types()->sync([$typeId => ['slot' => 1]]);

        $result = $this->service->list([
            'types' => [
                DB::table('types')
                    ->where('name', 'Electric')
                    ->first()
                    ->id
            ]
        ])->get();

        $this->assertCount(1, $result);
        $this->assertEquals('Pikachu', $result->first()->name);
    }
}
