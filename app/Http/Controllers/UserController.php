<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Account;

class UserController extends Controller
{
    function createBankAccount(Request $request)
    {
        $account = new Account;
        $account->username = session('username');
        $account->account_name = $request->accountName;
        $account->currency = $request->currency;
        $account->amount = 0;
        $account->save();
        return redirect('/user-menu');
    }

    function accountsList()
    {
        $accounts = Account::where('username', session('username'))->get();
        return view('accounts_list', ['accounts' => $accounts]);
    }
}