<?php

namespace Feature;

use App\Models\Pokemon;
use App\Models\Type;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TypeControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_can_list_all_types()
    {
        // Criando alguns tipos de exemplo
        Type::factory()->create(['name' => 'Electric']);
        Type::factory()->create(['name' => 'Fire']);
        Type::factory()->create(['name' => 'Water']);

        $response = $this->getJson(route('types.index'));

        $response->assertStatus(200)
            ->assertJsonStructure([
                'data' => [
                    '*' => [
                        'id',
                        'name',
                    ]
                ]
            ])
            ->assertJsonFragment(['name' => 'Electric'])
            ->assertJsonFragment(['name' => 'Fire'])
            ->assertJsonFragment(['name' => 'Water']);
    }

    public function test_it_returns_types_in_alphabetical_order()
    {
        // Criando tipos fora de ordem alfabética
        Type::factory()->create(['name' => 'Water']);
        Type::factory()->create(['name' => 'Electric']);
        Type::factory()->create(['name' => 'Fire']);

        $response = $this->getJson(route('types.index'));

        $response->assertStatus(200);

        $types = $response->json('data');

        // Verifica se os tipos estão em ordem alfabética
        $this->assertEquals(['Electric', 'Fire', 'Water'], array_column($types, 'name'));
    }
}
