<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Item;
use App\Jobs\SyncDataFromAPI;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Queue;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SyncDataFromAPITest extends TestCase
{
    use RefreshDatabase;

    /**
     * Testa a execução do job SyncDataFromAPI.
     *
     * @return void
     */
    public function test_sync_data_from_api()
    {
        // Mock da resposta da API
        Http::fake([
            'https://jsonplaceholder.typicode.com/posts' => Http::response([
                ['id' => 1, 'title' => 'Post 1', 'body' => 'Body 1'],
                ['id' => 2, 'title' => 'Post 2', 'body' => 'Body 2'],
            ], 200),
        ]);

        // Certifique-se de que não há registros no banco antes de rodar o job
        $this->assertCount(0, Item::all());

        // Dispara o job
        SyncDataFromAPI::dispatch();

        // Aguarda a execução do job
        $this->assertDatabaseCount('items', 2);  // Verifica se 2 registros foram inseridos

        // Verifica se o log foi gerado
        Log::shouldReceive('info')->once()->with('SyncDataFromAPI: 2 new items added.');

        // Verifica se as requisições foram feitas conforme esperado
        Http::assertSent(function ($request) {
            return $request->url() === 'https://jsonplaceholder.typicode.com/posts';
        });
    }

    /**
     * Testa o comportamento do job quando não há novos dados.
     *
     * @return void
     */
    public function test_sync_data_from_api_no_new_items()
    {
        // Cria um item no banco de dados
        Item::create([
            'id' => 1,
            'title' => 'Post 1',
            'body' => 'Body 1'
        ]);

        // Mock da resposta da API (com dados que já existem no banco)
        Http::fake([
            'https://jsonplaceholder.typicode.com/posts' => Http::response([
                ['id' => 1, 'title' => 'Post 1', 'body' => 'Body 1'],
            ], 200),
        ]);

        // Dispara o job
        SyncDataFromAPI::dispatch();

        // Verifica que nenhum novo item foi adicionado
        $this->assertDatabaseCount('items', 1);  // O banco ainda deve ter apenas 1 item

        // Verifica se o log foi gerado corretamente
        Log::shouldReceive('info')->once()->with('SyncDataFromAPI: 0 new items added.');
    }

    /**
     * Testa o comportamento do job em caso de erro na requisição.
     *
     * @return void
     */
    public function test_sync_data_from_api_with_error()
    {
        // Mock para simular erro na requisição
        Http::fake([
            'https://jsonplaceholder.typicode.com/posts' => Http::response([], 500),
        ]);

        // Verifica se o job captura e loga o erro
        Log::shouldReceive('error')->once()->with('Erro ao executar o job: Server error');

        // Dispara o job
        SyncDataFromAPI::dispatch();
    }
}
