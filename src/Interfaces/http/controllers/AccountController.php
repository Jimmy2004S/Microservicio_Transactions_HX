<?php

namespace Src\Interfaces\Http\controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Src\aplication\services\AccountService;

class AccountController extends Controller
{

    function __construct(private AccountService $accountService) {}

    public function create(Request $request)
    {

        $request->validate([
            'user_id' => 'required',
            'placeholder' => 'required'
        ]);

        $account = $this->accountService->createAccount($request->placeholder, $request->user_id);

        if (!$account) {
            return response()->json([
                'error' => 'Failed to create account'
            ], 500);
        }

        return response()->json([
            'data' => $account
        ], 201);
    }

    public function find(Request $request)
    {

        $account = $this->accountService->getAccountById($request->id);

        if (!$account) {
            return response()->json([
                'error' => 'Account not found'
            ], 404);
        }

        return response()->json([
            'data' => $account
        ], 200);
    }
}
