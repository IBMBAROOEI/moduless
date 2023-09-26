<?php


namespace app\Helper;

use Illuminate\Http\Response;

function handleStatusCodes($statusCode, $message = '', $data = null)
{
    $statusMessages = [
        Response::HTTP_OK => 'موفق',
        Response::HTTP_CREATED => 'ایجاد شد',
        Response::HTTP_NO_CONTENT => 'بدون محتوا',
        Response::HTTP_BAD_REQUEST => 'درخواست نامعتبر',
        Response::HTTP_UNAUTHORIZED => 'عدم مجوز',
        Response::HTTP_FORBIDDEN => 'ممنوع',
        Response::HTTP_NOT_FOUND => 'یافت نشد',
        Response::HTTP_METHOD_NOT_ALLOWED => 'متد مجاز نیست',
        Response::HTTP_INTERNAL_SERVER_ERROR => 'خطای داخلی سرور',
        Response::HTTP_UNPROCESSABLE_ENTITY => 'ورودی معتبر نیست',


    ];

    if (array_key_exists($statusCode, $statusMessages)) {
        $response = [
            'status' => $statusCode,
            'message' => $statusMessages[$statusCode],
        ];


        if (!is_null($data)) {
            $response['data'] = $data;
        }

        return response()->json($response, $statusCode);
    }

    return response()->json([
        'status' => $statusCode,
        'message' => 'کد وضعیت ناشناخته',
    ], $statusCode);


}













?>
