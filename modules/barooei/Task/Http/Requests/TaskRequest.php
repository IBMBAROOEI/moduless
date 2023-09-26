<?php

namespace barooei\Task\Http\Requests;

use barooei\Task\Models\Task;
use Illuminate\Foundation\Http\FormRequest;

class TaskRequest extends FormRequest
{



    public function authorize()
    {
        return true;
    }


    public function rules()
    {
        return [
            'title' => 'required|min:5',
            'description' => 'required',

        ];
    }





public function messages()
{
    return [
        'title.required' => 'فیلد عنوان الزامی است.',
        'title.min' => 'حداقل طول عنوان باید ۵ کاراکتر باشد.',
        'description.required' => 'فیلد توضیحات الزامی است.',
 
    ];
}

}
