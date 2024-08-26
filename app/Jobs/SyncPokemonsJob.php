<?php

namespace App\Jobs;

use App\Models\Pokemon;
use App\Models\Type;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Ramsey\Collection\Collection;

class SyncPokemonsJob implements ShouldQueue
{
    use InteractsWithQueue, Queueable, SerializesModels;

    public array $chunk;

    /**
     * Create a new job instance.
     */
    public function __construct(array $chunk)
    {
        $this->chunk = $chunk;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        DB::beginTransaction();
        try {
            foreach ($this->chunk as $pokemon) {
                $this->processPokemonsRecords($pokemon);
            }

            DB::commit();
        } catch (\Exception $exception) {
            DB::rollBack();

            Log::error($exception->getMessage());
        }
    }

    protected function processPokemonsRecords(array $pokemon): void
    {
        $pokemonDetails = Http::get($pokemon['url']);
        if (! $pokemonDetails->ok()) {
            Log::alert("Não foi possível recuperar detalhes do pokemon", [
                'name' => $pokemon['name'],
                'url' => $pokemon['url']
            ]);

            return;
        }

        $pokemonDetails = $pokemonDetails->json();

        if (! isset($pokemonDetails['types'])) {
            Log::alert("Não foi possível recuperar o tipo do pokemon", [
                'name' => $pokemon['name'],
                'url' => $pokemon['url']
            ]);

            return;
        }

        $types = [];
        foreach ($pokemonDetails['types'] as $type) {
            $currentType = $this->processPokemonTypes($type);
            if (empty($currentType)) {
                continue;
            }

            $types[$currentType->id] = [
                'slot' => $type['slot']
            ];
        }

        $pokemon = Pokemon::updateOrCreate([
            'name' => $pokemon['name'],
        ], [
            'height' => $pokemonDetails['height'],
            'weight' => $pokemonDetails['weight'],
        ]);

        $pokemon->types()->sync($types);
    }

    private function processPokemonTypes(array $type): ?Type
    {
        if (! isset($type['type']['name'])) {
            return null;
        }

        return Type::firstOrCreate([
            'name' => $type['type']['name'],
        ]);
    }
}
