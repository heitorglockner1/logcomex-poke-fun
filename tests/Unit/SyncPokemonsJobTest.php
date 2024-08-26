<?php

namespace Tests\Unit;

use App\Jobs\SyncPokemonsJob;
use App\Models\Pokemon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Tests\TestCase;

class SyncPokemonsJobTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_syncs_pokemons_successfully()
    {
        Http::fake([
            '*' => Http::response([
                'height' => 7,
                'weight' => 69,
                'types' => [
                    ['type' => ['name' => 'Electric'], 'slot' => 1]
                ]
            ], 200)
        ]);

        $chunk = [
            [
                'name' => 'Pikachu',
                'url' => 'https://pokeapi.co/api/v2/pokemon/25/'
            ]
        ];

        $job = new SyncPokemonsJob($chunk);
        $job->handle();

        $this->assertDatabaseHas('pokemons', [
            'name' => 'Pikachu',
            'height' => 7,
            'weight' => 69,
        ]);

        $this->assertDatabaseHas('types', [
            'name' => 'Electric',
        ]);

        $pokemon = Pokemon::where('name', 'Pikachu')->first();
        $this->assertTrue($pokemon->types()->where('name', 'Electric')->exists());
    }

    public function test_it_logs_an_error_when_http_request_fails()
    {
        Log::shouldReceive('alert')->once();

        Http::fake([
            '*' => Http::response([], 404)
        ]);

        $job = new SyncPokemonsJob([
            [
                'name' => 'Pikachu',
                'url' => 'https://pokeapi.co/api/v2/pokemon/25/'
            ]
        ]);
        $job->handle();

        $this->assertDatabaseMissing('pokemons', [
            'name' => 'Pikachu'
        ]);
    }
}
