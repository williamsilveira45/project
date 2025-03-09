<?php

namespace Tests\Feature;

use App\Modules\Users\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserAuthTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();
    }

    public function test_user_auth(): void
    {
        $email = 'testing@testing.com';
        $password = '@Testing##@!';
        $user = User::factory()->create([
            'email' => $email,
            'password' => bcrypt($password),
        ]);

        $response = $this->postJson('/api/users/login', [
            'email' => $email,
            'password' => $password,
        ]);

        $responseUser = json_decode($response->getContent());

        $response->assertStatus(200);
        $this->assertEquals($email, $responseUser->email);
        $this->assertEquals($user->id, $responseUser->id);
    }

    public function test_user_auth_fail(): void
    {
        $email = 'testing2@testing.com';
        $password = '@Testing##@!';
        User::factory()->create([
            'email' => $email,
            'password' => '12345678123',
        ]);

        $response = $this->postJson('/api/users/login', [
            'email' => $email,
            'password' => $password,
        ]);

        $message = json_decode($response->getContent());

        $response->assertStatus(403);
        $this->assertEquals('Invalid credentials', $message->message);
    }
}
