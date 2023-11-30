<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BankingController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LoginController;
use App\Models\User;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('login_form');
});

Route::post('submit-login', [LoginController::class, 'submitLogin']);

Route::get('/create-user', function () {
    return view('create_user');
});

Route::post('create-user-send', [LoginController::class, 'createUser']);

Route::get('/user-menu', function () {
    return view('user_menu');
})->middleware('checkUserSession');

Route::get('/agent-menu', function () {
    return view('agent_menu');
});

Route::get('/logout', [LoginController::class, 'logout']);

Route::get('/create-bank-account', function () {
    return view('form_create_bank_account');
})->middleware('checkUserSession');

Route::post('submit-form-create-bank-account', [UserController::class, 'createBankAccount']);

Route::get('/view-accounts', [UserController::class, 'accountsList'])->middleware('checkUserSession');










Route::get('/show-list', [BankingController::class, 'showAccounts']);

Route::get('/send-form-add', function () {
    return view('form_add_credit');
});

//testing github

Route::post('submit-form-add', [BankingController::class, 'addCredit']);
