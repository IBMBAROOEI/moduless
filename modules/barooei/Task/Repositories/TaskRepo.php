<?php

namespace barooei\Task\Repositories;

use barooei\Task\Http\Requests\TaskRequest;
use barooei\Task\Models\Task;

 class TaskRepo{

    public function all(){

        return Task::all();
     }



     public function store($request){

        $user = new Task();
        $user->title = $request->title;
        $user->description = $request->description;

        $user->user_id = $request->user_id;

        $user->type = Task::Pending;

      return $user;
     }


     public function show($id){

        return Task::findOrFail($id);
     }



     public function delete($id){

        return Task::findOrFail($id)->delete();
     }



     public function update($attributes, $task_id){


        $task = Task::findOrFail($task_id);
        $task->update($attributes);

        return $task;



     }



     public function updateEnumField($attributes, $task_id){


        $task = Task::findOrFail($task_id);
        $task->update($attributes);

        return $task;


     }


 }




















?>
