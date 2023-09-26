<?php

namespace barooei\User\Http\Controllers;

use App\Http\Controllers\Controller;
use barooei\User\Http\Requests\UserRequest;
use Illuminate\Support\Facades\Validator;


 use barooei\User\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Tymon\JWTAuth\Facades\JWTAuth;


use Illuminate\Http\Request;

class AuthUsersController extends Controller
{



        public function login(Request $request){


            $validator = Validator::make($request->all(), [
                'email' => 'required|email',
                'password' => 'required|string|min:8',
            ]);

            if ($validator->fails()) {
                return response()->json($validator->errors(), 422);
            }



            if (! $token = auth()->attempt($validator->validated())) {

                return response()->json(['error' => 'Unauthorized'], 401);
            }

              $user = Auth::user();

              $token = JWTAuth::fromUser($user);
              $response = [
                  'status' => 200,
                  'message' => 'عملیات با موفقیت انجام شد.',
                  'data' => [
                      'user' =>  $user,
                      'token'=>$token,
                      'expires_in' => JWTAuth::factory()->getTTL() * 60,
                      'refresh_token' => Auth::refresh(),

                  ]
              ];

              return response()->json($response);


        }




        // public function login(Request $request)
        // {
        //     $request->validate([
        //         'email' => 'required|string|email',
        //         'password' => 'required',
        //     ]);
        //     $credentials = $request->only('email', 'password');

        //     $token = Auth::attempt($credentials);
        //     if (!$token) {
        //         return response()->json([
        //             'status' => 'error',
        //             'message' => 'Unauthorized',
        //         ], 401);
        //     }

        // }

        public function register(UserRequest $request) {
                 $this->helpervalidation($request);
                $user = new User();
              $user->email = $request->email;
                $user->password = bcrypt($request->password);
                $user->save();

                $token = JWTAuth::fromUser($user);
                $response = [
                    'status' => 200,
                    'message' => 'عملیات با موفقیت انجام شد.',
                    'data' => [
                        'user' =>  $user,
                        'token'=>$token
                    ]
                ];

                return response()->json($response);


                //   return $this->respondWithToken($token);

    }


        public function logout() {
            auth()->logout();
            return response()->json(['message' => 'User successfully signed out']);
        }


        public function profile() {


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






    public function helpervalidation(Request $request){



        $validatedData = $request->validated();

        $validator = $this->getValidationFactory()->make($request->all(), $request->rules());


if ($validator->fails()) {
    return response()->json(['errors' => $validator->errors()], 422);
}


     return $validatedData;

    }


}

