<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use App\Models\Account;
use App\Models\Bank;
use Illuminate\Http\Request;

class BankingController extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    private $bank;
    public function __construct(){
        session_start();
        $sessionName = "bank";
        if (!isset($_SESSION[$sessionName])){
            $_SESSION[$sessionName] = new Bank();
        }
        $this->bank = &$_SESSION[$sessionName];
    }

    public function createAccount(Request $request){
        $account = new Account();
        $accountNum = $request->input('accountNum');
        $clientName = $request->input('clientName');
        $ammount = $request->input('ammount');
        $account->accountNum = $accountNum;
        $account->clientName = $clientName;
        $account->ammount = $ammount;
        $this->bank->addAccount($account);
        return redirect('/');
    }

    public function addCredit(){
        $accountNum = $_POST['account_num'];
        $ammount = $_POST['ammount'];
        $index = $this->bank->searchAccount($accountNum);
        if ($index>=0){
            $this->bank->addCredit($index, $ammount);
            return redirect('/');
        }
        else{
            return view('/send-form-add');
        }
        
    }

    public function showAccounts(){
        $accounts = $this->bank->getAllAccounts();
        return view('accounts_list', ['accounts' => $accounts]);
    }
}
