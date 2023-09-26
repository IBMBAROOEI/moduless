<?php

namespace barooei\Task\Http\Controllers;

use function barooei\Task\handleStatusCodes;
use App\Http\Controllers\Controller;
use barooei\Task\Http\Requests\TaskRequest;
use barooei\Task\Http\Requests\Taskupdate;
use Illuminate\Http\Response;
use barooei\Task\Repositories\TaskRepo;
use barooei\Task\Models\Task;


use App\Traits\Traitvalidation;
class TaskController extends Controller
{

 use Traitvalidation;
    public $repo;



    public function __construct(TaskRepo $TaskRepo)
    {
        $this->repo = $TaskRepo;
    }

    public function all()
    {

        $task = $this->repo->all();
        return \app\Helper\handleStatusCodes(Response::HTTP_OK, '', [$task]);


    }
    public function save(TaskRequest $request)
    {


        $this->helpervalidation($request);

        $task=$this->repo->store($request);
        return \app\Helper\handleStatusCodes(Response::HTTP_CREATED, '', [$task]);


        // return response()->json($response,201);
    }





    public function show($id)
    {
        $task=$this->repo->show($id);
        return \app\Helper\handleStatusCodes(Response::HTTP_OK, '', [$task]);

    }








    public function delete($id)
    {

        $task=$this->repo->delete($id);

        return \app\Helper\handleStatusCodes(Response::HTTP_NO_CONTENT, '', [$task]);

    }



    public function update($task_id,TaskRequest $request)
    {

        $this->helpervalidation($request);



       $task= $this->repo->update($task_id, $request);

       return \app\Helper\handleStatusCodes(Response::HTTP_OK, '', [$task]);
    }



    public function updateEnumField(Taskupdate $request, $task_id)
    {


        $this->helpervalidation($request);

        $attributes = [
            'type' => $request->type,

        ];


        $task=$this->repo->updateEnumField($attributes,$task_id);
        return \app\Helper\handleStatusCodes(Response::HTTP_OK, '', [$task]);
    }




    public function helpervalidation(Request $request)
    {



        $validatedData = $request->validated();


        $validator = $this->getValidationFactory()->make($request->all(), $request->rules());


        if ($validator->fails()) {
            return \app\Helper\handleStatusCodes(Response::HTTP_UNPROCESSABLE_ENTITY, '', [$validator->errors()]);
            // return response()->json([], 422);
        }


        return $validatedData;
    }
}
