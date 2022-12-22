<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class SignupTest extends TestCase
{

    use RefreshDatabase;

    /**
     * it can check name, email and password required
     *
     * @test
     */
    public function canCheckRequireNameEmailAndPassword()
    {
        $this->withExceptionHandling();

        $this->postJson(route('signup'))
            ->assertStatus(422)
            ->assertJson([
                'message' => 'The given data was invalid.',
                'errors' => [
                    'name' => ['The name field is required.'],
                    'email' => ['The email field is required.'],
                    'password' => ['The password field is required.'],
                ]
            ]);
    }

    /**
     * it can check require password confirmation
     *
     * @test
     */
    public function canCheckRequirePasswordConfirmation()
    {
        $this->withExceptionHandling();

        $register = [
            'name' => 'User',
            'email' => 'user@test.com',
            'password' => 'password',
        ];

        $this->postJson(route('signup', $register))
            ->assertStatus(422)
            ->assertJson([
                'message' => 'The given data was invalid.',
                'errors' => [
                    'password' => ['The password confirmation does not match.']
                ]
            ]);
    }

    /**
     * it can register successfully
     *
     * @test
     */
    public function canRegisterSuccessfully()
    {
        $register = [
            'name' => 'UserTest',
            'email' => 'user@test.com',
            'password' => '12345678',
            'password_confirmation' => '12345678'
        ];
        $this->postJson(route('signup', $register))
            ->assertStatus(201)
            ->assertJsonStructure([
                'success',
                'message',
                'data'
            ]);
        $this->assertDatabaseHas('rzy_users',['name' => 'UserTest']);
    }
}
