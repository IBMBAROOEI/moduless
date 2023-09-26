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



            return response()->json(['message' => 'خطا در احراز هویت'], 401);
        }
    }



}








// class AuthMiddleware
// {

//     public function handle(Request $request, Closure $next): Response
//     {
//         try {
//             $user = JWTAuth::parseToken()->authenticate();
//             dd($user);
//         } catch (\Exception $e) {
//             if ($e instanceof \Tymon\JWTAuth\Exceptions\TokenExpiredException) {
//                 // توکن منقضی شده است، رفرش توکن
//                 $refreshedToken = JWTAuth::refresh();
//                 // ذخیره توکن جدید در هدر درخواست
//                 $request->headers->set('Authorization', 'Bearer ' . $refreshedToken);
//                 // ادامه اجرای درخواست
//                 return $next($request);
//             }
//             // خطای دیگری رخ داده است، مثلاً توکن نامعتبر است
//             return response()->json(['error' => 'Unauthorized'], 401);
//         }

//         // توکن صحیح است، ادامه اجرای درخواست
//         return $next($request);
//     }
//     }



// }
// }












