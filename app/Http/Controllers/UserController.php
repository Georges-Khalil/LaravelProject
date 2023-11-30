<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Account;
use App\Models\Transaction;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    function createBankAccount(Request $request)
    {
        $existingAccount = Account::where('username', session('username'))
        ->where('account_name', $request->accountName)
            ->first();

        if ($existingAccount) {
            return redirect('/create-bank-account')->with('error', 'Account name already exists');
        }
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

    function transactionHistory()
    {
        $username = session('username');
        $transactions = Transaction::where('username', $username)
            ->orWhere('receiving_username', $username)
            ->get();
        return view('transaction_history', ['transactions' => $transactions]);
    }

    function transferFunds(Request $request)
    {
        $senderUsername = session('username');
        $recipientUsername = $request->recipient_username;

        $senderAccount = Account::where('account_name', $request->sender_account_name)
            ->where('username', $senderUsername)
            ->first();
        $recipientAccount = Account::where('account_name', $request->recipient_account_name)
            ->where('username', $recipientUsername)
            ->first();

        if ($senderAccount == null) {
            return redirect('/transfer-funds-form')->with('error', 'Sender account does not exist');
        }
        if ($recipientAccount == null) {
            return redirect('/transfer-funds-form')->with('error', 'Recipient account does not exist');
        }

        if($senderAccount->approved == 0){
            return redirect('/transfer-funds-form')->with('error', 'Sender account is closed');
        }
        if($recipientAccount->approved == 0){
            return redirect('/transfer-funds-form')->with('error', 'Recipient account is closed');
        }

        if (!is_numeric($request->amount)) {
            return redirect('/transfer-funds-form')->with('error', 'Amount must be a number');
        }
        if ($request->amount <= 0) {
            return redirect('/transfer-funds-form')->with('error', 'Amount must be positive');
        }

        $senderBalanceUSD = $this->convertToUSD($senderAccount->amount, $senderAccount->currency);
        $recipientBalanceUSD = $this->convertToUSD($recipientAccount->amount, $recipientAccount->currency);
        $amountUSD = $this->convertToUSD($request->amount, $request->currency);

        if ($senderBalanceUSD < $amountUSD) {
            return redirect('/transfer-funds-form')->with('error', 'Insufficient funds');
        }

        $senderBalanceUSD = $senderBalanceUSD - $amountUSD;
        $recipientBalanceUSD = $recipientBalanceUSD + $amountUSD;

        DB::table('accounts')
        ->where('username', $senderUsername)
        ->where('account_name', $request->sender_account_name)
        ->update(['amount' => $this->convertFromUSD($senderBalanceUSD, $senderAccount->currency)]);

        DB::table('accounts')
        ->where('username', $recipientUsername)
        ->where('account_name', $request->recipient_account_name)
        ->update(['amount' => $this->convertFromUSD($recipientBalanceUSD, $recipientAccount->currency)]);

        $transaction = new Transaction;
        $transaction->username = $senderAccount->username;
        $transaction->account_name = $senderAccount->account_name;
        $transaction->receiving_username = $recipientAccount->username;
        $transaction->receiving_account_name = $recipientAccount->account_name;
        $transaction->transaction_amount = $request->amount;
        $transaction->currency = $request->currency;
        $transaction->save();

        return redirect('/user-menu');
    }

    function convertToUSD($amount, $currency)
    {
        switch ($currency) {
            case 'EUR':
                return $amount / 1.19;
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
                return $amount * 1.19;
            case 'LBP':
                return $amount * 89700;
            default:
                return $amount;
        }
    }
}