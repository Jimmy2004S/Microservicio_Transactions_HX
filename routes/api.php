<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Src\Infraestructure\Persistence\Models\Account;
use Src\Interfaces\Http\controllers\AccountController;
use Src\Interfaces\Http\controllers\TransactionController;
use Src\Interfaces\http\middlewares\AuthMiddleware;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::get('/', function (Request $request) {
    return 'Hellow world';
});

Route::post('/transactions/send', [TransactionController::class, 'send'])->middleware([AuthMiddleware::class])->name('transactions.send');

Route::post('/account', [AccountController::class, 'create'])->name('transactions.send');
Route::get('/account/{id}', [AccountController::class, 'find'])->name('transactions.send');

Route::post('transactions/purchase', [TransactionController::class, 'send'])->name('transactions.purchase')->middleware([AuthMiddleware::class]);


Route::post('transactions/recharge', [TransactionController::class, 'send'])->name('transactions.purchase');
