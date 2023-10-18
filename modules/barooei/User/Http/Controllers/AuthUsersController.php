<?php

namespace barooei\User\Http\Controllers;

use App\Http\Controllers\Controller;
use barooei\User\Http\Requests\UserRequest;
use Illuminate\Support\Facades\Validator;
use barooei\User\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Tymon\JWTAuth\Facades\JWTAuth;


use App\Helper\Helpervalidate;


use Illuminate\Http\Response;

use barooei\User\Repositories\UserRepo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;

class AuthUsersController extends Controller
{



    public $repo;

    public function __construct(UserRepo $UserRepo)
    {
        $this->repo = $UserRepo;
    }


    public function login(UserRequest $request)
    {


       Helpervalidate::helpervalidation($request);
       $credentials = $request->only('email', 'password');

       $token=$this->repo->login($credentials);

       if(!$token){
        return \app\Helper\handleStatusCodes(Response::HTTP_UNAUTHORIZED, '', []);
       }

        return \app\Helper\handleStatusCodes(Response::HTTP_OK, '', [$token]);





    }






    public function register(UserRequest $request)
    {
        Helpervalidate::helpervalidation($request);
        $User=$this->repo->register($request);
      

        return \app\Helper\handleStatusCodes(Response::HTTP_CREATED, 'ایمیل خود را چک کنید', [$User]);





    }


    public function logout()
    {
        auth()->logout();
        return response()->json(['message' => 'User successfully signed out']);
    }


    public function profile()
    {


        $response = [
            'status' => 200,
            'data' => [
                Auth::user()
            ]
        ];
        return response()->json($response);
    }




    public function refresh($token)
    {


        $token = JWTAuth::parseToken()->refresh();

        return response()->json([
            $token
        ]);

        // $tokk=$this->respondWithToken($token);
        // return $tokk;

    }

    public function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',

            'expires_in' => JWTAuth::factory()->getTTL() * 60,
            'refresh_token' => Auth::refresh(),
        ]);
    }






    public function helpervalidation(Request $request)
    {



        $validatedData = $request->validated();

        $validator = $this->getValidationFactory()->make($request->all(), $request->rules());


        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }


        return $validatedData;
    }
}
