<?php

namespace barooei\Task\Repositories;

use barooei\Task\Http\Requests\TaskRequest;
use barooei\Task\Models\Task;
use Illuminate\Support\Facades\Auth;

 class TaskRepo{

    public function all(){

        return Task::all();
     }



     public function store($request){


        return Task::create([
            'title' =>$request->title,
            'description' =>$request->description,
            'user_id' =>auth()->user()->id,

            'type' => Task::Pending,
        ]);

     }


     public function show($id){

        return Task::findOrFail($id);
     }



     public function getusertsak(){

        return Task::where("user_id",Auth::id())->get();
     }



     public function delete($id){

        return Task::findOrFail($id)->delete();
     }



     public function update($task_id,$request){



        $task = Task::findOrFail($task_id);

        $task->update([
            'title' => $request->input('title'),
            'description' => $request->input('description'),
        ]);

        return $task;

     }



     public function updateEnumField($attributes, $task_id){


        $task = Task::findOrFail($task_id);
        $task->update($attributes);

        return $task;


     }


 }




















?>
