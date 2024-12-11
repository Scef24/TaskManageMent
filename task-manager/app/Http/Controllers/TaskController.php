<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\TaskBackupController;


class TaskController extends Controller
{
    public function index(){
        try{
            $id = Auth::id();
            $tasks = Task::where('user_id',$id)
                ->where('status','!=','completed')
                ->orderBy('due_date','asc')
            ->get();
            $categories = Categories::where('user_id',$id)->get();
            return view('user.home', compact('tasks','categories'));
        }   
        catch(\Exception $e){
           Log::error('Error retrieving tasks: ' . $e->getMessage());
            return redirect()->route('guest.login')->with('error','Fail to Retrieve Tasks',$e->getMessage());
        }
    }

    public function addTask(Request $request){
        try{
     
            $validatedData = $request->validate([
                'title' => 'required|string|max:255',
                'description' => 'nullable|string',
                'due_date' => 'required|date|after:today',
                'status' => 'required|in:pending,in_progress,completed',
                'priority' => 'required|in:low,medium,high',
                'category_id' => 'required|exists:categories,id',
                
            ]);
            $validatedData['user_id'] = Auth::id();
            Task::create($validatedData);
            $backup = new TaskBackupController();
            $backup->backup();
            return redirect()->route('user.home')->with('success', 'Task Added Successfully');
        } catch (\Exception $e) {
            return redirect()->route('user.home')->with('error', 'Failed to Add Task: ' . $e->getMessage());
        }
    }
    
    public function editTask(Request $request, $id) {
        try {
            $task = Task::findOrFail($id);

            $validatedData = $request->validate([
                'title' => 'required|string|max:255',
                'description' => 'nullable|string',
                'due_date' => 'required|date|after:today',
                'status' => 'required|in:pending,in_progress,completed',
                'priority' => 'required|in:low,medium,high',
                'category_id' => 'required|exists:categories,id',
            ]);

            $task->update($validatedData);

            return redirect()->route('user.home')->with('success', 'Task Updated Successfully');
        } catch (\Exception $e) {
            return redirect()->route('user.home')->with('error', 'Failed to Update Task: ' . $e->getMessage());
        }
    }

    public function delete($id){
        try{
        $task = Task::find($id);
            if(!$task){
                return view('user.home')->with('Error','NO Id Found');
            }

            $task->delete();
            return redirect()->route('user.home')->with('Success','Task Deleted Successfully');
        }
        catch(\Exception $e){
            return redirect()->route('user.home')->with('Error','Task Deletion Error',$e->getMessage());
        }
    }
    public function done($id){
        try{

            $task = Task::find($id);
            if(!$task){
                return redirect()->route('user.home')->with('Error','No Task Found');
            }
            $task->status = 'completed';
            $task->save();
            return redirect()->route('task.done')->with('Success','Task Marked as Done');
        }
        catch(\Exception $e){
            return redirect()->route('user.home')->with('Error','Task Marking as Done Error',$e->getMessage());
        }
    }
    public function doneTask(){
        try{
            $id = Auth::id();
            $tasks = Task::where('user_id',$id)
                ->where('status','completed')
                ->orderBy('due_date','asc')
            ->get();
            return view('task.done', compact('tasks'));
        }
        catch(\Exception $e){
            return redirect()->route('user.home')->with('Error','Task Marking as Done Error',$e->getMessage());
        }
    }
}
