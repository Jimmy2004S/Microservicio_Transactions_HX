<?php

namespace Src\Aplication\Services;

use Exception;
use Src\Domain\Repositories\IAccountRepository;
use Src\Domain\Repositories\ITransactionRepository;
use Src\Domain\Services\ITransactionService;

class TransactionService implements ITransactionService
{
    public function __construct(
        private ITransactionRepository $transactionRepository,
    ) {}

    public function sendTransaction($amount, $from_account_id, $to_account_id)
    {
        try {
            $transaction = $this->transactionRepository->createTransaction(
                'outcome',
                $amount,
                $from_account_id,
                $to_account_id,
                'succesfull'
            );

            if (!$transaction) return null;

            return $transaction->toArray();
        } catch (Exception $e) {
            throw new Exception($e->getMessage()); // Se puede mejorar (ver punto 3)
        }
    }
}
