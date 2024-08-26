<?php

namespace App\Console\Commands;

use App\Jobs\SyncPokemonsJob;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;

class SyncPokemonsCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:sync-pokemons {limit=100}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sincronização dos Pokemons';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $limit = $this->argument('limit');

        if (empty(env('POKEMON_API_URL'))) {
            $this->error('URL de consulta não configurada.');
            return 1;
        }

        $response = Http::get(env('POKEMON_API_URL'), [
            'limit' => $limit,
        ]);

        if (! $response->ok()) {
            $this->error('Não foi possível realizar a consulta.');
            return 1;
        }

        $responseJson = $response->json();
        if (! isset($responseJson['results'])) {
            $this->error('Não foi possível recuperar os resultados da consulta..');
            return 1;
        }

        $chunks = array_chunk($responseJson['results'], 20);

        foreach ($chunks as $chunk) {
            SyncPokemonsJob::dispatch($chunk);
        }

        $this->info("Sincronização de pokemons enviada para a fila com limite de {$limit} registros.");
    }
}
