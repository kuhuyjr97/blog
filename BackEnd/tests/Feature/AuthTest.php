<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Enums\ResponseEnum;
use Illuminate\Support\Facades\Hash;
use App\Infrastructure\Eloquent\EloquentUser;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AuthTest extends TestCase
{
    use RefreshDatabase;
    private $user;

    public function setUp(): void
    {
        parent::setUp();
        $this->user = EloquentUser::factory()->create([
            'email' => 'test@gmail.com',
            'password' => Hash::make('Asdasd123@'),
        ]);
    }
    public function testLoginWithCorrectCredentials()
    {
        $response = $this->postJson('/api/v1/auth/login', [
            'email' => 'test@gmail.com',
            'password' => 'Asdasd123@',
        ]);
        $response->assertJson([
            'response_status' => ResponseEnum::RES_STATUS_SUCCESS,
        ], ResponseEnum::HTTP_STATUS_SUCCESS);
    }

    public function testLoginWithIncorrectCredentials()
    {
        $response  = $this->postJson('/api/v1/auth/login', [
            'email' => 'test@gmail.com',
            'password' => 'Asdasd123@@',
        ]);
        $response->assertJson(
            [
                'response_status' => ResponseEnum::RES_STATUS_LOGIN_FAILED,
                'response_body' => [
                    'message' => [
                        'error' => ResponseEnum::RES_MSG_ERR_LOGIN_FAILED,
                    ]
                ]
            ],
            ResponseEnum::HTTP_STATUS_UNAUTHENTICATED
        );
    }

    public function testLoginWithIncorrectPasswordFormat()
    {
        $response  = $this->postJson('/api/v1/auth/login', [
            'email' => 'test@gmail.com',
            'password' => 'Asdasd123',
        ]);
        $response->assertJson(
            [
                'response_status' => ResponseEnum::RES_STATUS_ERROR_VALIDATE,
                'response_body' => [
                    'message' => [
                        'password' => 'The password format is invalid.',
                    ]
                ]
            ],
            ResponseEnum::HTTP_STATUS_ERROR
        );
        $response->assertJson([
            'response_body' => [
                'message' => []
            ],
        ]);
    }

    public function testLoginWithIncorrectEmailFormat()
    {
        $response  = $this->postJson('/api/v1/auth/login', [
            'email' => 'testgmail.com',
            'password' => 'Asdasd123',
        ]);
        $response->assertJson(
            [
                'response_status' => ResponseEnum::RES_STATUS_ERROR_VALIDATE,
                'response_body' => [
                    'message' => [
                        'email' => 'The email must be a valid email address.',
                    ]
                ]
            ],
            ResponseEnum::HTTP_STATUS_ERROR
        );
        $response->assertJson([
            'response_body' => [
                'message' => []
            ],
        ]);
    }

    public function testLogoutWithCorrectToken()
    {
        $loginResponse = $this->postJson(
            '/api/v1/auth/login',
            [
                'email' => 'test@gmail.com',
                'password' => 'Asdasd123@',
            ]
        );
        $token = $loginResponse->json()['response_body']['token'];
        $lougoutResponse = $this->withHeaders([
            'Authorization' => 'Bearer ' . $token
        ])->postJson('api/v1/auth/logout', []);
        $lougoutResponse->assertJson(
            [
                'response_status' => ResponseEnum::RES_STATUS_SUCCESS,
                'response_body' => [
                    'message' => ResponseEnum::RES_MSG_SUCCESS,
                ]
            ],
            ResponseEnum::HTTP_STATUS_SUCCESS
        );
    }

    public function testLogoutWithIncorrectToken()
    {
        $token = 'wrongtoken';

        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $token,
        ])->postJson('api/v1/auth/logout', []);

        $response
            ->assertStatus(ResponseEnum::HTTP_STATUS_UNAUTHENTICATED)
            ->assertJson([
                'response_status' => ResponseEnum::RES_STATUS_TOKEN_FAILED,
                'response_body' => [
                    'message' => [
                        'error' => ResponseEnum::RES_MSG_ERR_TOKEN_FAILED,
                    ],
                ],
            ], ResponseEnum::HTTP_STATUS_UNAUTHENTICATED);
    }
}
