<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;
use App\Models\TaskBackup;
use Illuminate\Support\Facades\Auth;

class TaskBackupController extends Controller
{
    public function backup(){
        $user = Auth::user();
    
        $task = Task::where('user_id',$user->id)->get();
       

        $dataToBackup = [
            'task'=>$task,
           
        ];
       TaskBackup::create([
            'user_id'=>$user->id,
            'data'=>json_encode($dataToBackup),
        ]);
    }
}
