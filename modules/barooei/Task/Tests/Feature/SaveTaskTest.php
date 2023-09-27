<?php

namespace barooei\Task\Tests\Feature;

use barooei\Task\Models\Task;
use Illuminate\Foundation\Testing\RefreshDatabase;
// use Illuminate\Foundation\Testing\WithFaker;


use barooei\User\Models\User;

use Tests\TestCase;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Foundation\Testing\WithFaker;

class SaveTaskTest extends TestCase
{

    use WithFaker, RefreshDatabase;

    /**
     * A basic feature test example.
     *
     */



    public function test_SaveTaskTest(): void
    {

        $user = User::create([
            'name' => 'kpokpkpk کاربر',
            'email' => 'usejojor@example.com',
            'password' => bcrypt('password'),
        ]);


        $token = JWTAuth::fromUser($user);
        $this->actingAs($user)->withHeaders([
            'Authorization' => 'Bearer' . $token
        ]);


        $response = $this->post(url('api/task/save'), [
            'title' => 'abcdedfg',
            'description' => 'abscd',
            'user_id' => $user->id,

        ]);

        $response->assertStatus(201);

        $this->assertDatabaseHas('tasks', [
            'title' => 'abcdedfg',
            'description' => 'abscd',
            'user_id' => $user->id,
            'type' => Task::Pending,
        ]);
    }





    public function test_UpdateTaskTest(): void
    {

        $user = User::create([
            'name' => 'kpokpkpk کاربر',
            'email' => 'usejojor@example.com',
            'password' => bcrypt('password'),
        ]);


        $token = JWTAuth::fromUser($user);
        $this->actingAs($user)->withHeaders([
            'Authorization' => 'Bearer' . $token
        ]);

        // ایجاد یک وظیفه اولیه توسط کاربر
        $task = Task::create([
            'title' =>' از بروزرسانی',
            'description' => 'توضیحات قبل از بروزرسانی',
            'user_id' => $user->id,
        ]);



        $response=$this->put(url('api/task/update', [$task->id]), [
            'title' => 'mb1656514110',
            'description' => 'mb6666664564',
            'user_id' => $user->id,
        ]);

        $response->assertStatus(200);

        $this->assertDatabaseHas('tasks', [
            'title' => 'mb1656514110',
            'description' => 'mb6666664564',
            'user_id' => $user->id,
            'type' => Task::Pending,
        ]);
    }




    public function test_getTaskTest(): void
    {


        $user = User::create([
            'name' => 'kpokpkpkکاربر',
            'email' => 'usejojor@example.com',
            'password' => bcrypt('password'),
        ]);


        $token = JWTAuth::fromUser($user);
        $this->actingAs($user)->withHeaders([
            'Authorization' => 'Bearer' . $token
        ]);


     $tasks  = Task::create([
        'title' => 'abcdedfg',
        'description' => 'abscd',
        'user_id' => $user->id,
        'type' => Task::Pending,
    ]);

     $response=$this->get('api/task/all');

     $response->assertStatus(200);

     $response->assertJson([

        'data'=>[
            $tasks
        ]
        ]);


    }
}
