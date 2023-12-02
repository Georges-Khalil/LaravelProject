<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Account;
use App\Models\Transaction;
use Illuminate\Support\Facades\DB;

class AgentController extends Controller
{
    
    public function accessUser(Request $request)
    {
        return redirect('/');
    }


}