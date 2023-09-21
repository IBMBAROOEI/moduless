<?php

namespace barooei\Task\Http\Requests;

// use barooei\Task\Models\Task;

use barooei\Task\Models\Task;
use Illuminate\Foundation\Http\FormRequest;

class Taskupdate extends FormRequest
{



    public function authorize()
    {
        return true;
    }



        public function rules()
        {
            return [
                'type' => 'required|in:' . implode(',', Task::$type),
            ];
        }






public function messages()
{
    return[

        'type.required'=>'نوع تایپ رو مشخص کن ',


    ];
}

}
