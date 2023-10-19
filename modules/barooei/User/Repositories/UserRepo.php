<?php

namespace barooei\User\Repositories;

use barooei\User\Mail\VerificationEmail;
use barooei\Task\Http\Requests\TaskRequest;
use barooei\User\Models\User;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\URL;

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


        $verificationLink = URL::signedRoute('verification.verify', ['id' => $user->id, 'hash' => sha1($user->email)]);

        Mail::to($user->email)->send(new VerificationEmail($verificationLink));

        return [
          "User"=>  $user,
           "token"=> $token

        ];

    }

 }




















?>
