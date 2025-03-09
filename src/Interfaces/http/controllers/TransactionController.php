<?php

namespace Src\Interfaces\Http\controllers;

use App\Http\Controllers\Controller;
use Exception;
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
            'to_account_number' => 'required|exists:accounts,number'
        ]);

        try {

            // $user = $request->user;

            $transaction = $this->transactionService->sendTransaction($request->amount, 1, 'jimmisiitho450@gmail.com', $request->to_account_number);

            if (!$transaction) {
                return response()->json([
                    'error' => 'Failed to send transaction'
                ], 500);
            }

            return response()->json([
                'data' => $transaction
            ], 201);
        } catch (Exception $e) {
            return response()->json([
                'error' => 'Error sending transaction',
            ], 500);
        }
    }
}
