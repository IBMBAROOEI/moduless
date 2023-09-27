<?php

namespace barooei\User\Repositories;

use barooei\Task\Http\Requests\TaskRequest;
use barooei\User\Models\User;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Facades\Auth;

 class UserRepo{




     public function login($credentials){



        if (!$token = auth()->attempt($credentials)) {


            return false;
        }

        $user = Auth::user();

        $token = JWTAuth::fromUser($user);
        return [
                'user' =>  $user,
                'token' => $token,
                'expires_in' => JWTAuth::factory()->getTTL() * 60,
                'refresh_token' => Auth::refresh(),

        ];
    }






     public function register($request){

        $user = new User();
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->save();
        $token = JWTAuth::fromUser($user);
        return [
          "User"=>  $user,
           "token"=> $token

        ];

    }

 }




















?>
