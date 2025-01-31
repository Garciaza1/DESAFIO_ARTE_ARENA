<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use App\Models\Item;
use Illuminate\Http\Response;
use Tests\TestCase;

class ItemControllerTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function test_it_can_list_items_with_pagination()
    {
        // Criar itens de exemplo com a fábrica
        Item::factory()->count(15)->create();

        // Fazer uma requisição GET à rota de listagem de itens
        $response = $this->get('/items');

        // Verificar se a resposta é bem-sucedida e contém dados de itens
        $response->assertStatus(200);
        $response->assertJsonStructure([
            'data' => [
                '*' => ['id', 'title', 'body']
            ],
        ]);
    }

    /** @test */
    public function test_it_can_filter_items_by_title()
    {
        // Criar itens de exemplo
        Item::factory()->count(5)->create(['title' => 'some_title']);

        // Fazer a requisição GET com o parâmetro 'title'
        $response = $this->get('/items?title=some_title');

        // Verificar se a resposta é bem-sucedida
        $response->assertStatus(200);

        // Verificar a estrutura JSON da resposta, considerando a chave 'data'
        $response->assertJsonStructure([
            'current_page',
            'data' => [
                '*' => ['id', 'title', 'body'],  // Estrutura esperada para cada item dentro de 'data'
            ],
        ]);
    }



    /** @test */
    public function it_can_create_a_new_item()
    {
        // Dados para criar um novo item
        $data = [
            'title' => 'New Item',
            'body' => 'This is the body of the new item.',
        ];

        // Fazer requisição POST para a rota de store
        $response = $this->postJson('/items', $data);

        // Verificar se o item foi criado com sucesso
        $response->assertStatus(201);
        $response->assertJson([
            'title' => 'New Item',
            'body' => 'This is the body of the new item.',
        ]);

        // Verificar se o item foi realmente salvo no banco de dados
        $this->assertDatabaseHas('items', [
            'title' => 'New Item',
            'body' => 'This is the body of the new item.',
        ]);
    }

    /** @test */
    public function validation_create_an_item()
    {
        // Fazer requisição POST sem fornecer título e corpo
        $response = $this->postJson('/items', []);

        // Verificar se a validação de erro ocorre
        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
        $response->assertJsonValidationErrors(['title', 'body']);
    }
}
