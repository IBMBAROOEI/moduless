<?php

namespace barooei\User\Http\Middleware;

use Closure;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AuthMiddleware
{

    public function handle(Request $request, Closure $next): Response
    {
        try {
            $user = JWTAuth::parseToken()->authenticate();


            if (!$user) {
                return response()->json(['message' => 'کاربر نامعتبر'], 401);
            }



            return $next($request);
        } catch (\Throwable $e) {


            dd($e);
            return response()->json(['message' => 'خطا در احراز هویت'], 401);
        }
    }

}
