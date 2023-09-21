<?php

namespace barooei\Task\Http\Controllers;

use barooei\Task\Models\Task;
use App\Http\Controllers\Controller;
use barooei\Task\Http\Requests\TaskRequest;
use barooei\Task\Http\Requests\Taskupdate;

use barooei\Task\Repositories\TaskRepo;
// use Illuminate\Support\Facades\Validator;

use Illuminate\Http\Request;

class TaskController extends Controller
{


    public $repo;

    public function __construct(TaskRepo $TaskRepo)
    {
        $this->repo = $TaskRepo;
    }

    public function all()
    {

        $task = $this->repo->all();



        $response = [
            'status' => 200,
            'message' => 'عملیات با موفقیت انجام شد.',
            'data' => [
                $task
            ]
        ];

        return response()->json($response);
    }



    public function save(TaskRequest $request)
    {


        $this->helpervalidation($request);

        $task=$this->repo->store($request);


        $response = [
            'status' => 200,
            'message' => 'عملیات با موفقیت انجام شد.',
            'data' => [
                $task
            ]
        ];

        return response()->json($response);
    }





    public function show($id)
    {
        $tasks=$this->repo->show($id);
        $response = [
            'status' => 200,
            'message' => 'عملیات با موفقیت انجام شد.',
            'data' => [
                $tasks
            ]
        ];

        return response()->json($response);
    }








    public function delete($id)
    {

        $this->repo->delete($id);
        $response = [
             204,
        ];

        return response()->json($response);
    }



    public function update(TaskRequest $request, $task_id)
    {

        $this->helpervalidation($request);


        $attributes = [
            'title' => $request->title,
            'description' => $request->description,
            'user_id' => $request->user_id,
        ];

        $task=$this->repo->update($attributes,$task_id);


        $response = [
            'data' =>
            $task,


        ];

        return response()->json($response);
    }



    public function updateEnumField(Taskupdate $request, $task_id)
    {


        $this->helpervalidation($request);

        $attributes = [
            'type' => $request->type,
         
        ];

        $task=$this->repo->update($attributes,$task_id);

        return response()->json([$task], 200);
    }




    public function helpervalidation(Request $request)
    {



        $validatedData = $request->validated();


        $validator = $this->getValidationFactory()->make($request->all(), $request->rules());


        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }


        return $validatedData;
    }
}
