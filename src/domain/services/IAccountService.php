<?php

namespace Src\domain\services;

use Src\Domain\Entities\IAccount;

interface IAccountService
{
    public function createAccount($balance, $number, $placeholder, $cvc, $due_date, $user_id): IAccount;
}
