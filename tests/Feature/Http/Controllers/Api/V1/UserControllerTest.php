<?php

namespace Tests\Feature\Http\Controllers\Api\V1;

use App\Models\Tenant;
use App\Models\Unit;
use App\Models\User;
use App\Services\TenantManager;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Log;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class UserControllerTest extends TestCase
{
    use RefreshDatabase;

    private Tenant $tenant;

    private Unit $unit;
    private User $adminUser;

    protected function setUp(): void
    {
        parent::setUp();

        // 1. Criamos o cenário inicial: Um Tenant e um usuário Admin
        $this->tenant = Tenant::factory()->create();

        $this->unit = Unit::factory()->create([
            'tenant_id' => $this->tenant->id,
        ]);

        // Configuramos o Singleton para o contexto do teste
        app(TenantManager::class)->setTenant($this->tenant);

        $this->adminUser = User::factory()->create([
            'tenant_id' => $this->tenant->id,
            'unit_id' => $this->unit->id,
        ]);
    }

    #[Test]
    public function an_authenticated_user_can_create_a_new_user_within_their_tenant()
    {
        // 2. Simulamos a autenticação JWT
        // O actingAs funciona com o jwt-auth se o guard padrão for 'api'
        $this->actingAs($this->adminUser, 'api');
        Log::info("Usuário autenticado para teste: {$this->adminUser->email} (Tenant ID: {$this->adminUser->tenant_id})");

        $userData = [
            'name'     => 'Novo Usuário Kariri',
            'email'    => 'novo@karirisaude.com.br',
            'password' => 'password123',
        ];

        // 3. Execução do POST
        $response = $this->postJson('http://localhost/api/v1/users', $userData);

        // 4. Asserções
        $response->assertStatus(201);

        // Verificamos se o usuário foi criado no banco vinculado ao Tenant correto
        $this->assertDatabaseHas('users', [
            'email'     => 'novo@karirisaude.com.br',
            'tenant_id' => $this->tenant->id
        ]);
    }

    #[Test]
    public function it_fails_to_create_user_without_authentication()
    {
        $response = $this->postJson('/api/v1/users', [
            'name' => 'Should Fail'
        ]);

        $response->assertStatus(401);
    }


    #[Test]
    public function a_user_cannot_create_a_user_for_another_tenant()
    {
        $outroTenant = Tenant::factory()->create();
        $this->actingAs($this->adminUser, 'api');

        $userData = [
            'name'      => 'Invasor',
            'email'     => 'invasor@teste.com',
            'password'  => '12345678',
            'tenant_id' => $outroTenant->id // Tentando injetar outro tenant
        ];

        $response = $this->postJson('http://localhost/api/v1/users', $userData);

        Log::info("Resposta da criação de usuário: " . $response->getContent());
        Log::info("status code: " . $response->getStatusCode());

        // O sistema deve ignorar o tenant_id enviado e usar o do Singleton/Autenticado
        $this->assertDatabaseHas('users', [
            'email'     => 'invasor@teste.com',
            'tenant_id' => $this->tenant->id // Tenant do admin autenticado
        ]);
    }

    #[Test]
    public function an_authenticated_user_can_retrieve_paginated_users_list()
    {
        // Arrange: Criamos múltiplos usuários para testar a paginação
        User::factory(15)->create([
            'tenant_id' => $this->tenant->id,
            'unit_id' => $this->unit->id,
        ]);

        $this->actingAs($this->adminUser, 'api');

        // Act: Executamos a requisição GET com paginação padrão (5 por página)
        $response = $this->getJson('/api/v1/users');

        // Assert: Verificamos a estrutura da resposta
        $response->assertStatus(200)
            ->assertJsonStructure([
                'current_page',
                'data' => [
                    '*' => [
                        'id',
                        'tenant_id',
                        'friendly_id',
                        'unit_id',
                        'name',
                        'email',
                        'email_verified_at',
                        'is_active',
                        'created_at',
                        'updated_at',
                        'deleted_at',
                    ]
                ],
                'first_page_url',
                'from',
                'last_page',
                'last_page_url',
                'links' => [
                    '*' => [
                        'url',
                        'label',
                        'active',
                    ]
                ],
                'next_page_url',
                'path',
                'per_page',
                'prev_page_url',
                'to',
                'total',
            ]);
        // Verificamos os dados de paginação
        $this->assertEquals(1, $response->json('current_page'));
        $this->assertEquals(5, $response->json('per_page'));
        $this->assertEquals(16, $response->json('total')); // 15 + 1 (admin) criados no setUp
        $this->assertEquals(4, $response->json('last_page'));
    }
}
