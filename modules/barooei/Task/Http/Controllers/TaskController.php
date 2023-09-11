<?php

namespace barooei\Task\Http\Controllers;
 use barooei\Task\Models\Task;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Validator;

use Illuminate\Http\Request;

class TaskController extends Controller
{




    public function save(Request $request) {
        // $this->helpervalidation($request);
       $user = new Task();
     $user->title = $request->title;
     $user->description = $request->description;

       $user->user_id=$request->user_id;

       $user->type=Task::Pending;

       $user->save();


       $response = [
           'status' => 200,
           'message' => 'عملیات با موفقیت انجام شد.',
           'data' => [
               $user
           ]
       ];

       return response()->json($response);



    }





 public function show(){
     $task=Task::query()->get();

     $response = [
        'status' => 200,
        'message' => 'عملیات با موفقیت انجام شد.',
        'data' => [
            $task
        ]
    ];

    return response()->json($response);

 }








 public function delete($id){

    Task::find($id)->delete();

    $response=[
        'status' => 204,
    ];

    return response()->json($response);
 }



  public function update(Request $request,$task_id){


    $task=Task::findOrfail($task_id);
    $task->update($request->all());

$response=[
    'data'=>
        $task,


];

return response()->json($response);

  }

  

}
