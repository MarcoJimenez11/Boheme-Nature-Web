<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserTest extends TestCase
{
    use RefreshDatabase;

    public function test_loads_home(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function test_loads_login(): void
    {
        $response = $this->get('/login');

        $response->assertStatus(200);
    }

    public function test_loads_register(): void
    {
        $response = $this->get('/register');

        $response->assertStatus(200);
    }

    public function test_register_new_user(): void
    {
        $this->post('/register',[
            'userName' => 'Marco',
            'userEmail' => 'marco@test.com',
            'userPassword' => '11'
        ]);

        $this->assertCredentials( [
            'name' => 'Marco',
            'email' => 'marco@test.com',
            'password' => '11'
        ]);
    }
}
