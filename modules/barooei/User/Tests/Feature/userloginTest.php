<?php

namespace barooei\User\Tests\Feature;

use barooei\User\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class userloginTest extends TestCase
{

    use WithFaker, RefreshDatabase;

    /** test check user login */
    public function test_Userlogin(): void
    {
        $user = User::create([
            'email' => $this->faker->safeEmail,

            'password' => 'password'
        ]);


        $response = $this->post(url('api/user/login'), [

            'email' => $user->email,
            'password' => 'password'
        ]);
      
        $response->assertOk();
        $this->assertAuthenticated();
    }


    // public function test_user_token_response(): void
    // {
    //     $user = User::create([
    //         'email' => $this->faker->safeEmail,

    //         'password' => 'password'
    //     ]);

    //     $response = $this->post(url('api/user/login'), [

    //         'email' => $user->email,
    //         'password' => 'password'
    //     ]);
    //     $response->assertOk();
    //    $response->assertJsonStructure([

    //     'access_token',
    //     'token_type' ,
    //     'expires_in',
    //     'refresh_token',
    //    ]);
    // }





    /** test for genarate_token */


    //  public function testresponsewithtoken(){

    //     $token="tets_token";



    //     $response=$this->respondWithToken($token);

    //         $response->assertOk();
    //         $response->assertJson([


    //         ]);
    //  }
}
