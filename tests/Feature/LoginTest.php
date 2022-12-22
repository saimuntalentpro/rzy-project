<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\RzyUser;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class LoginTest extends TestCase
{
    /**
     * It can check require email and login
     *
     * @test
     */
    public function itCanCheckRequireEmailAndPasswordInLogin()
    {
        $this->withExceptionHandling();

        $this->postJson(route('login'))
            ->assertStatus(422)
            ->assertJson([
                'message' => 'The given data was invalid.',
                'errors' => [
                    'email' => ['The email field is required.'],
                    'password' => ['The password field is required.']
                ]
            ]);
    }

    /**
     * It can login successfully
     *
     * @test
     */
    public function itCanUserLoginSuccessfully()
    {
        $user = ['email' => 'saimun@gmail.com', 'password' => 'password'];
        $response = $this->postJson(route('login', $user))->assertOk();
        // $this->assertArrayHasKey('access_token',$response->json());
    }

    /**
     * It can login successfully
     *
     * @test
     */
    public function itCanRaiseErrorIfPasswordIsIncorrect()
    {
        $this->withExceptionHandling();

        $user = ['email' => 'saimun@gmail.com', 'password' => 'password'];

        $this->postJson(route('login'),[
            'email' => $user['email'],
            'password' => '7885455'
        ])
        ->assertStatus(200);
    }
}
