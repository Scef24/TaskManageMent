<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Backup;
class BackupController extends Controller
{
    public function backup($id){
        try{
            $user = User::find($id);
            
            $userData = [
                'first_name'=>$user->first_name,
                'last_name'=>$user->last_name,
                'username'=>$user->username,
                'email'=>$user->email,
                'password'=>$user->password,
            ];
             Backup::create([
                'user_id'=>$user->id,
                'data'=>json_encode($userData),  
            ]);
           
        }
        catch(\Exception $e){
            return redirect()->route('guest.registration')->with('error','Failed to Backup: '.$e->getMessage());
        }
    }
}
