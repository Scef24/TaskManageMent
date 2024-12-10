<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;


class TaskController extends Controller
{
    public function index(){
        try{
           
            $tasks = Task::all();
            $categories = Categories::all();
            return view('user.home', compact('tasks','categories'));
        }   
        catch(\Exception $e){
           
            return redirect()->route('user.home')->with('error','Fail to Retrieve Tasks');
        }
    }

    public function addTask(Request $request){
        try{
     
            $validatedData = $request->validate([
                'title' => 'required|string|max:255',
                'description' => 'nullable|string',
                'due_date' => 'required|date',
                'status' => 'required|in:pending,in_progress,completed',
                'priority' => 'required|in:low,medium,high',
                'category_id' => 'required|exists:categories,id',
                
            ]);
            $validatedData['user_id'] = Auth::id();
            Task::create($validatedData);

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
                'due_date' => 'required|date',
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
}
