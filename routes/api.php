<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Src\Interfaces\Http\controllers\TransactionController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');



Route::post('/transactions/send', [TransactionController::class, 'send'])->name('transactions.send');
