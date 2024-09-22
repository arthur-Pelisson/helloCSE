<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Administrateur;
use Laravel\Sanctum\Sanctum;
use App\Models\Profil;
class ProfilRessourceAdminTest extends TestCase
{
    protected $admin;
    protected $profil;

    protected function setUp(): void
    {
        parent::setUp();
        // Create an admin user
        $this->admin = Administrateur::factory()->create();
        Sanctum::actingAs($this->admin);

        // Create a profil
        // $profil = Profil::factory()->create();
    }

    protected function tearDown(): void
    {
        // Delete the admin user
        $this->admin->delete();
        parent::tearDown();
    }
    /**
     * A basic feature test example.
     */
    public function test_admin_get_profil(): void
    {
        $response = $this->getJson('/api/profil');
        $response->assertStatus(200);
        $response->assertExactJsonStructure([
            '*' => [ 
                'id',
                'nom',
                'prenom',
                'image',
                'statut',
                'created_at',
                'updated_at'
            ]
        ]);
    }

    public function test_admin_create_profil(): void
    {

        $response = $this->postJson('/api/profil', [
            'nom' => fake()->name(),
            'prenom' => fake()->lastName(),
            'image' => fake()->image(),
            'statut' => fake()->randomElement(["actif", "inactif", "en attente"]),
        ]);

        $response->assertStatus(201);
        $response->assertJson([
            'message' => 'Profile create'
        ]);
        $profil = Profil::latest()->first(); 
        $profil->delete();
    }

    public function test_admin_update_profil(): void
    {
        $profil = Profil::factory()->create();
        $response = $this->putJson('/api/profil/' . $profil->id, [
            'nom' => fake()->name(),
            'prenom' => fake()->lastName(),
            'image' => fake()->image(),
            'statut' => fake()->randomElement(["actif", "inactif", "en attente"]),
        ]);

        $response->assertStatus(200);
        $response->assertJson([
            'message' => 'Profile updated'
        ]);
        $profil->delete();
    }

    public function test_admin_delete_profil(): void
    {
        
        $profil = Profil::factory()->create();
        $response = $this->deleteJson('/api/profil/' . $profil->id);
        $response->assertStatus(200);
        $response->assertJson([
            'message' => 'Profile deleted'
        ]);
        $profil->delete();
    }
}
