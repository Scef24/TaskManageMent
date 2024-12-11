<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class CategoriesController extends Controller
{
    public function index(){
        try{
            $categories = Categories::all();
            return view('user.home',compact('categories'));
        }
        catch(\Exception $e){
            return redirect()->route('user.home')->with('Error','Error Retrieving Task', $e->getMessage());
        }
    }
    
    public function addCategories(Request $request){
        try{
            $validatedData = $request->validate([
                'name' => 'required|string|max:255'
            ]);
            $validatedData['user_id'] = Auth::id();
            Categories::create($validatedData);

            return redirect()->route('user.home')->with('success', 'Category Added Successfully');
        }
        catch(\Exception $e){
            return redirect()->route('user.home')->with('error', 'Error adding Category: ' . $e->getMessage());
        }
    }
}
