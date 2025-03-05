<?php


namespace Src\domain\services;

use Src\Domain\Entities\ITransaction;

interface ITransactionService
{
    public function sendTransaction($amount, $from_account_id, $to_account_id);
}
