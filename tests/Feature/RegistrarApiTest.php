<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RegistrarApiTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function admin_can_create_a_registrar_via_api(): void
    {
        // Fake admin user
        $admin = User::factory()->create(['role' => 'admin']);

        $payload = [
            'name'  => 'Demo Registrar',
            'email' => 'demo@example.com',
        ];

        $response = $this->actingAs($admin)
            ->postJson('/api/v1/registry/registrars', $payload);

        $response->assertCreated();

        $this->assertDatabaseHas('registrars', [
            'email' => 'demo@example.com',
        ]);
    }
}
