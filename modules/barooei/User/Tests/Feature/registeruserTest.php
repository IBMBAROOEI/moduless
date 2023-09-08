<?php

namespace barooei\User\Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
// use Illuminate\Foundation\Testing\WithFaker;


use barooei\User\Models\User;

use Tests\TestCase;

class registeruserTest extends TestCase
{

    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     */



    public function test_user_can_register(): void {
        $response = $this->post(url('api/user/register'), [
            'email' => "j88j@umail.com",
            'password' => '123456781212121',
        ]);
        $responseData = $response->json();
        $this->assertArrayHasKey('user', $responseData['data']);
        $this->assertArrayHasKey('token', $responseData['data']);
        $this->assertCount(1, User::all());
    }
}
