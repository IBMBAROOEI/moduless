<?php
namespace app\Traits;
use Illuminate\Http\Response;

use Illuminate\Http\Request;

// use Illuminate\Support\Facades\Validator;

 class Traitvalidation{


    public function helpervalidation(Request $request)
    {

        // getValidationFactory

        $validatedData = $request->validated();


        $validator = $this->getValidationFactory()->make($request->all(), $request->rules());


        if ($validator->fails()) {
            return \app\Helper\handleStatusCodes(Response::HTTP_UNPROCESSABLE_ENTITY, '', [$validator->errors()]);

        }


        return $validatedData;
    }
 }

