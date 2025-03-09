<?php


namespace Src\domain\services;

use Src\Domain\Entities\ITransaction;

interface ITransactionService
{
    public function sendTransaction(float $amount, $from_account_id, $from_account_email, $to_account_id);
}
