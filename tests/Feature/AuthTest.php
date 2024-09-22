<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use App\Models\Administrateur;
use Tests\TestCase;

class AuthTest extends TestCase
{
    protected $admin;
    /**
     * Set up admin user for testing.
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        // Create an admin user
        $this->admin = Administrateur::factory()->create();
        $this->admin->password = "password";
    }

    /**
     * Delete admin user after testing.
     *
     * @return void
     */
    protected function tearDown(): void
    {
        // Delete the admin user
        $this->admin->delete();
        parent::tearDown();
    }
    /*
    * Basic test admin login success.
    */
    public function test_administrateur_login_success()
    {
        // Attempt to log in
        $response = $this->postJson('/api/auth/login', [
            'email' => $this->admin->email,
            'password' => $this->admin->password,
        ]);

        $response->assertStatus(200)
            ->assertJsonStructure([
                'token',
            ]);
    }

    /*
    * Basic test admin login error.
    */
    public function test_administrateur_login_error()
    {
        // Attempt to log in with invalid credentials
        $response = $this->postJson('/api/auth/login', [
            'email' => 'admin@example.com',
            'password' => 'wrongpassword',
        ]);

        $response->assertStatus(401)
            ->assertJson(['message' => 'Bad credentials']);
    }
}
