<?php

namespace Src\Interfaces\Http\controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Src\Aplication\Services\TransactionService;

class TransactionController extends Controller
{

    function __construct(private TransactionService $transactionService) {}

    public function send(Request $request)
    {

        $request->validate([
            'amount' => 'required|numeric|min:0.01',

            'to_account_id' => 'required'
        ]);

        $transaction = $this->transactionService->sendTransaction($request->amount, $request->auth_user['id'], $request->to_account_id);

        if (!$transaction) {
            return response()->json([
                'error' => 'Failed to send transaction'
            ], 500);
        }

        return response()->json([
            'data' => $transaction
        ], 201);
    }
}
