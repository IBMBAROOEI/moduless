<?php

namespace barooei\User\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
{



    public function authorize()
    {
        return true;
    }


    public function rules()
    {
        return [

            'email' => 'required|email',
                'password' => 'required|string|min:6',

        ];
    }





public function messages()
{
    return[
        'name.required' => 'نام وارد نکردید',
         'email.required' => 'وارد کردن ایمیل الزامی است!',
        'email.email.required' => 'آدرس ایمیل معتبر نمی باشد!',

        'password.required'=>'پسورد رو وارد نکردید',
        'password_confirmation.required' =>'پسورد مطابق نیست',


    ];
}

}
