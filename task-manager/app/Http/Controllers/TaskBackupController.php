<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;
use App\Models\TaskBackup;
use Illuminate\Support\Facades\Auth;
use App\Models\Categories;
class TaskBackupController extends Controller
{
    public function backup(){
        $user = Auth::user();
    
        $task = Task::where('user_id',$user->id)->get();
        $categories = Categories::where('user_id',$user->id)->get();

        $dataToBackup = [
            'task'=>$task,
            'categories'=>$categories,
        ];
       TaskBackup::create([
            'user_id'=>$user->id,
            'data'=>json_encode($dataToBackup),
        ]);
    }
}
