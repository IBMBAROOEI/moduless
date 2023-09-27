<?php
namespace app\Helper;
use Illuminate\Support\Facades\Request;
use Illuminate\Http\Response;

 class Helpervalidate {

    public static function helpervalidation($request)
    {
        $validator = \Illuminate\Support\Facades\Validator::make($request->all(), $request->rules());

        if ($validator->fails()) {
            return \app\Helper\handleStatusCodes(\Illuminate\Http\Response::HTTP_UNPROCESSABLE_ENTITY, '', [$validator->errors()]);
        }

        return true;
    }
 }
