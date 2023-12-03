<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Account;
use Illuminate\Support\Facades\DB;


class AgentController extends Controller
{
    public function accountsList()
    {
        $accounts = Account::all();

        return view('accounts_list_agent', ['accounts' => $accounts]);
    }

    public function changeStatus(Request $request)
    {
        $username = $request->input('username');
        $account_name = $request->input('account_name');

        $account = DB::table('accounts')
            ->where('username', $username)
            ->where('account_name', $account_name)
            ->first();

        if ($account->approved == 1) {
            DB::table('accounts')
                ->where('username', $username)
                ->where('account_name', $account_name)
                ->update(['approved' => 0]);
        } 
        else {
            DB::table('accounts')
                ->where('username', $username)
                ->where('account_name', $account_name)
                ->update(['approved' => 1]);
        }

        return redirect('/view-accounts-agent');
    }
}

