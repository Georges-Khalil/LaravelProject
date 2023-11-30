<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LoginController;

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

Route::get('/transfer-funds-form', function () {
    return view('form_add_credit');
})->middleware('checkUserSession');

Route::post('submit-form-transfer', [UserController::class, 'transferFunds']);

Route::get('/view-transaction-history', [UserController::class, 'transactionHistory'])->middleware('checkUserSession');