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
    return view('form_add_credit');
})->middleware('checkUserSession');

Route::post('submit-form-transfer', [UserController::class, 'transferFunds']);

Route::get('/view-transaction-history', [UserController::class, 'transactionHistory'])->middleware('checkUserSession');


Route::get('/access-user', function () {
    return view('access_user');
});

Route::post('submit-access-user', [AgentController::class, 'accessUser']);  //this is the route that is called when the form is submitted in access_user.blade.php view