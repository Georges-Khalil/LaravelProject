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
                ->update(['approved' => 2]);
        }
        else if ($account->approved == 2) {
            DB::table('accounts')
                ->where('username', $username)
                ->where('account_name', $account_name)
                ->update(['approved' => 1]);
        }
        else {
            DB::table('accounts')
                ->where('username', $username)
                ->where('account_name', $account_name)
                ->update(['approved' => 1]);
        }

        return redirect('/view-accounts-agent');
    }

    public function depositWithdraw(Request $request)
    {
        $username = $request->input('username');
        $account_name = $request->input('account_name');
        $amount = $request->input('amount');
        $currency = $request->input('currency');

        $account = DB::table('accounts')
            ->where('username', $username)
            ->where('account_name', $account_name)
            ->first();
        
        if ($account == null) {
            return redirect('/deposit-withdraw')->with('error', 'Account not found');
        }
        if($account->approved != 1){
            return redirect('/deposit-withdraw')->with('error', 'Account not open');
        }
        if(!is_numeric($amount)){
            return redirect('/deposit-withdraw')->with('error', 'Amount must be numeric');
        }

        $balanceUSD = $this->convertToUSD($account->amount, $account->currency);
        $amountUSD = $this->convertToUSD($amount, $currency);
        if($amountUSD <= 0){
            if($balanceUSD < abs($amountUSD)){
                return redirect('/deposit-withdraw')->with('error', 'Insufficient funds');
            }
            $balanceUSD = $balanceUSD + $amountUSD;
            DB::table('accounts')
            ->where('username', $username)
            ->where('account_name', $account_name)
            ->update(['amount' => $this->convertFromUSD($balanceUSD, $account->currency)]);

        }
        else{
            $balanceUSD = $balanceUSD + $amountUSD;
            DB::table('accounts')
            ->where('username', $username)
            ->where('account_name', $account_name)
            ->update(['amount' => $this->convertFromUSD($balanceUSD, $account->currency)]);
        }
        return redirect('/agent-menu');
    }

    function convertToUSD($amount, $currency)
    {
        switch ($currency) {
            case 'EUR':
                return $amount / 0.93;
            case 'LBP':
                return $amount / 89700;
            default:
                return $amount;
        }
    }

    function convertFromUSD($amount, $currency)
    {
        switch ($currency) {
            case 'EUR':
                return $amount * 0.93;
            case 'LBP':
                return $amount * 89700;
            default:
                return $amount;
        }
    }
}

