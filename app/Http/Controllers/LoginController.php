<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class LoginController extends Controller
{
    public function submitLogin(Request $request){
        $username = $request->input('username');
        $password = $request->input('password');
        
        // Use the User model to fetch the user from the database
        $user = User::where('username', $username)->first();
        
        // Check if the user exists and the password is correct
        if ($user && password_verify($password, $user->password)){
            $_SESSION['username'] = $username;
            return redirect('controller.php'); // Use Laravel's redirect function
        }
        else{
            return back()->with('error', 'Incorrect login'); // Redirect back with an error message
        }
    }

    public function createUser(Request $request){
        $username = $request->input('username');
        $password = $request->input('password');
        
        // Use the User model to fetch the user from the database
        $user = User::where('username', $username)->first();
        
        // Check if the user exists and the password is correct
        if ($user){
            return back()->with('error', 'Username already exists'); // Redirect back with an error message
        }
        else{
            $user = new User();
            $user->username = $username;
            $user->password = password_hash($password, PASSWORD_DEFAULT);
            $user->save();
            return redirect('/'); // Use Laravel's redirect function
        }
    }
}
