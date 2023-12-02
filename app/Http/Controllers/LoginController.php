<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class LoginController extends Controller
{
    public function submitLogin(Request $request){
        $username = $request->input('username');
        $password = $request->input('password');
        
        $user = User::where('username', $username)->first();
        
        if ($user && password_verify($password, $user->password)){
            $request->session()->put('username', $username);
            if($user->isagent == 1){
                return redirect('/agent-menu');
            }
            else{
                return redirect('/user-menu');
            }
        }
        else{
            return back()->with('error', 'Incorrect login');
        }
    }

    public function createUser(Request $request){
        $username = $request->input('username');
        $password = $request->input('password');
        
        $user = User::where('username', $username)->first();    //check if username already exists
        
        if ($user){
            return back()->with('error', 'Username already exists');    //if username exists, return to create_user.blade.php with error message
        }
        else{
            $user = new User();
            $user->username = $username;
            $user->password = password_hash($password, PASSWORD_DEFAULT);
            $user->save();
            return redirect('/');
        }
    }

    public function logout(Request $request){
        $request->session()->forget('username');
        return redirect('/');
    }
}
