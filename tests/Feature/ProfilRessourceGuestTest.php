<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Profil;
class ProfilRessourceGuestTest extends TestCase
{
    protected $profil;

    protected function setUp(): void
    {
        parent::setUp();
        // Create a profil
        $this->profil = Profil::factory()->create();
    }

    protected function tearDown(): void
    {
        // Delete the profil
        $this->profil->delete();
        parent::tearDown();
    }
    public function test_guest_can_get_profil(): void
    {

        $response = $this->getJson('/api/profil');
        $response->assertStatus(200);
        $response->dump();
        $response->assertExactJsonStructure([
            '*' => [ 
                'id',
                'nom',
                'prenom',
                'image',
                'created_at',
                'updated_at'
            ]
        ]);
    }

    public function test_guest_cannot_create_profil(): void
    {
        $response = $this->postJson('/api/profil', [
            'nom' => fake()->name(),
            'prenom' => fake()->lastName(),
            'image' => fake()->image(),
            'statut' => fake()->randomElement(["actif", "inactif", "en attente"]),
        ]);

        $response->assertStatus(401);
    }

    public function test_guest_cannot_update_profil(): void
    {
        
        $response = $this->putJson('/api/profil/' . $this->profil->id, [
            'nom' => fake()->name(),
            'prenom' => fake()->lastName(),
            'image' => fake()->image(),
            'statut' => fake()->randomElement(["actif", "inactif", "en attente"]),
        ]);

        $response->assertStatus(401);
    }

    public function test_guest_cannot_delete_profil(): void
    {
        $response = $this->deleteJson('/api/profil/' . $this->profil->id);
        $response->assertStatus(401);
    }
}
