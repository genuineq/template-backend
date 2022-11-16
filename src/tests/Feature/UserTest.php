<?php

namespace Tests\Feature;

use Tests\TestCase;

class UserTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_register()
    {
        $response = $this->postJson('api/register', ['email' => 'stefanghiban962@gmail.com', 'password' => 'test1234', "password_confirm" => 'test1234', "terms_and_conditions" => true, "name" => "Stefan Ghiban"]);

        $response->assertStatus(200);
    }

    public function loginFormValidationProvider(): array
    {
        return [
            'Email missing' => ['email', ''],
            'Wrong email format' => ['email', 'fera.admin'],
            'Password missing' => ['password', ''],
        ];
    }

    /**
     * @dataProvider loginFormValidationProvider
     */
    public function testLoginMissing($formInput, $formInputValue): void
    {
        $response = $this->postJson(
            '/api/login',
            [
                $formInput => $formInputValue,
            ]
        );

        $response->assertStatus(422);
        $response->assertJsonValidationErrors($formInput);
    }
}
