<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showRegisterForm()
    {
        return view('guest.registration');
    }

    function register(Request $request){
        try{

        
        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'username' => 'required|unique:users',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8',
        ]);

        $data['first_name'] = $request->first_name;
        $data['last_name'] = $request->last_name;
        $data['username'] = $request->username;
        $data['email'] = $request->email;
        $data['password'] = Hash::make($request->password);
        $user = User::create($data);

        if(!$user){
            return redirect(route('guest.registration'))->with("error","Registration details are not valid");
        }


        return redirect(route('login'))->with("success","Registration Success");
    }
    catch(\Exception $e){
        return redirect(route('guest.registration'))->with("error",$e->getMessage());
    }
    }

    public function showLoginForm()
    {
        return view('guest.login');
    }

    public function login(Request $request)
{
    try{

   
    $request->validate([
        'email' => 'required',
        'password' => 'required',

    ]);

    $credentials = $request->only('email', 'password');

    if (Auth::attempt($credentials)) {
        $request->session()->regenerate();
        return redirect()->intended(route('user.home'))->with('success', 'Login successful');
    }

    return redirect(route('guest.login'))->with("error", "Login details are not valid");
}
catch(\Exception $e){
    return redirect(route('guest.login'))->with("error",$e->getMessage());
}
}
function logOut(Request $request){
    try{

    
    $request->session()->flush();
    Auth::logout();
    return redirect(route('login'))->with("success","Logout successful");
    }
    catch(\Exception $e){
        return redirect(route('user.home'))->with("error",$e->getMessage());
    }
}
}
