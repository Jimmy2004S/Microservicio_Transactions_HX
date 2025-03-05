<?php

namespace Src\Domain\Repositories;

use Illuminate\Support\Facades\Date;
use Src\Domain\Entities\ITransaction;
use Src\Domain\Entities\Transaction;

interface ITransactionRepository
{
    public function createTransaction(
        string $type,
        float $amount,
        int $from_account_id,
        int $to_account_id,
        string $status
    ): ITransaction;
}
