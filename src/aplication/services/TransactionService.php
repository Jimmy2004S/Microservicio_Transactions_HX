<?php

namespace Src\Aplication\Services;

use Src\Domain\Repositories\IAccountRepository;
use Src\Domain\Repositories\ITransactionRepository;
use Src\domain\services\ITransactionService;
use Src\Infraestructure\persistence\repositories\TransactionRepository;
use Src\Infraestructure\persistence\repositories\AccountRepository;

class TransactionService implements ITransactionService
{

    public function __construct(
        private ITransactionRepository $transactionRepository,
        private IAccountRepository $accountRepository
    ) {}

    public function sendTransaction($type, $amount, $from_account_id, $to_account_id, $status)
    {
        return $this->transactionRepository->createTransaction('income', $amount, $from_account_id, $to_account_id, 'successfull');
    }
}
