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
                $request->session()->put('isagent', 1);
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
        
        $user = User::where('username', $username)->first();
        
        if ($user){
            return back()->with('error', 'Username already exists');
        }
        else{
            $user = new User();
            $user->username = $username;
            $user->password = password_hash($password, PASSWORD_DEFAULT);
            $user->save();
            return redirect('/');
        }
    }

    public function accessUser(Request $request){
        $username = $request->username;
        $user = User::where('username', $username)->first();
        if ($user && $user->isagent == 0){
            session(['username' => $username]);
            session()->forget('isagent');
            return redirect('/user-menu');
        }
        else{
            return back()->with('error', 'Username does not exist');
        }
    }

    public function logout(Request $request){
        $request->session()->forget('username');
        $request->session()->forget('isagent');
        return redirect('/');
    }
}
