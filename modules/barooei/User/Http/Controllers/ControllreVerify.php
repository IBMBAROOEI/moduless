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

use barooei\User\Mail\VerificationEmail;

use Illuminate\Http\Response;

use barooei\User\Repositories\UserRepo;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\URL;

class ControllreVerify extends Controller
{



    public function verifyEmail( $id, $hash)
    {

    $user = User::find($id);

    if (!$user) {
        return response()->json(['message' => 'کاربری با این شناسه وجود ندارد'], 404);
    }

    if ($user->email_verified_at) {
        return response()->json(['message' => 'ایمیل قبلاً تایید شده است.'], 200);
    }

    $emailHash = sha1($user->email);

    if (!hash_equals((string) $hash, $emailHash)) {
        return response()->json(['message' => 'لینک تایید ایمیل معتبر نیست.'], 400);
    }

    $user->email_verified_at = Carbon::now();
    $user->save();

    return response()->json(['message' => 'ایمیل با موفقیت تایید شد.'], 200);
}




public function resendVerificationEmail(Request $request)
{
    $user = $request->user();

    if ($user->hasVerifiedEmail()) {
        return response()->json(['message' => 'ایمیل شما قبلاً تایید شده است.'], 200);
    }

    $verificationLink = URL::signedRoute('verification.verify', ['id' => $user->id, 'hash' => sha1($user->email)]);

    Mail::to($user->email)->send(new VerificationEmail($verificationLink));

    // ارسال ایمیل جدید حاوی لینک تایید به کاربر
    // می‌توانید از بسته‌های ارسال ایمیل مانند Laravel Mail استفاده کنید

    return response()->json(['message' => 'لینک تایید ایمیل مجدداً برای شما ارسال شد.'], 200);
}

}
