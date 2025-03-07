<?php

namespace Src\Interfaces\Http\controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Src\Domain\Repositories\IAccountRepository;
use Src\domain\services\ITransactionService;

class TransactionController extends Controller
{

    function __construct(
        private ITransactionService $transactionService
    ) {}

    public function send(Request $request)
    {

        $request->validate([
            'amount' => 'required|numeric|min:0.01',
            'to_account_number' => 'required'
        ]);

        $transaction = $this->transactionService->sendTransaction($request->amount, $request->auth_user->id, $request->to_account_number);

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
