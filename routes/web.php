<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BankingController;

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
    return view('main_menu');
});

Route::get('/show-list', [BankingController::class, 'showAccounts']);

Route::get('/send-form-create', function () {
    return view('form_create_account');
});

Route::post('submit-form-create', [BankingController::class, 'createAccount']);

Route::get('/send-form-add', function () {
    return view('form_add_credit');
});

//testing github

Route::post('submit-form-add', [BankingController::class, 'addCredit']);