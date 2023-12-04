<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\AgentController;

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
})->middleware('checkAgentSession');

Route::get('/logout', [LoginController::class, 'logout']);

Route::get('/create-bank-account', function () {
    return view('form_create_bank_account');
})->middleware('checkUserSession');

Route::post('submit-form-create-bank-account', [UserController::class, 'createBankAccount']);

Route::get('/view-accounts', [UserController::class, 'accountsList'])->middleware('checkUserSession');

Route::get('/transfer-funds-form', function () {
    return view('form_transfer_funds');
})->middleware('checkUserSession');

Route::post('submit-form-transfer', [UserController::class, 'transferFunds']);

Route::get('/view-transaction-history', [UserController::class, 'transactionHistory'])->middleware('checkUserSession');

Route::get('/access-user', function () {
    return view('access_user');
})->middleware('checkAgentSession');

Route::post('submit-access-user', [LoginController::class, 'accessUser']);

Route::get('/view-accounts-agent', [AgentController::class, 'accountsList'])->middleware('checkAgentSession');

Route::post('change-status', [AgentController::class, 'changeStatus'])->middleware('checkAgentSession');

Route::get('/deposit-withdraw', function () {
    return view('form_deposit_withdraw');
})->middleware('checkAgentSession');

Route::post('submit-form-deposit-withdraw', [AgentController::class, 'depositWithdraw'])->middleware('checkAgentSession');