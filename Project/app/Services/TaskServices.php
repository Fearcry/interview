<?php

namespace App\Services;

use App\Models\UserTasks;
use Illuminate\Support\Facades\Auth;

class TaskServices
{

    public function getTasks()
    {
        $user = Auth::user();
        return UserTasks::where('user_id', $user->id)->orderBy('created_at','DESC');
    }
    public function create($req)
    {
        $user = Auth::user();
        UserTasks::create([
            'user_id' => $user->id,
            'content' => $req->content
        ]);
    }
    public function delete($id)
    {

        if(!Auth::check()){
            throw new \Exception("You are not authorized to delete this task.");
        }

        $user = Auth::user();
        $task = UserTasks::where('id', $id)->first();
        if(!isset($task)){
            throw new \Exception("Such a task does not exist.");
        }
        if($user->id != $task->user_id){
            throw new \Exception("You are not authorized to delete this task.");
        }
        $task->delete();
    }
}
