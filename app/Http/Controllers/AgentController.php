<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Account;
use App\Models\Transaction;
use Illuminate\Support\Facades\DB;


class AgentController extends Controller
{
    // function view all accounts
    function viewAllAccounts()
    {
        $accounts = Account::all();
        return view('view_all_accounts', ['accounts' => $accounts]);
    }

    
    public function accessUser(Request $request)
    {
        $username = $request->input('username');
        $user = User::where('username', $username)->first();
        if ($user) {
            $request->session()->put('username', $username);
                return redirect('/user-menu');
        } 
        else {
            return back()->with('error', 'Incorrect login');
        }
    }

}

