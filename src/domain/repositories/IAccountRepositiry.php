<?php

namespace Src\Domain\Repositories;

use Illuminate\Support\Facades\Date;
use Src\Domain\Entities\Account;
use Src\Domain\Entities\IAccount;

interface IAccountRepository
{
    public function createAccount(
        float $balance,
        int $number,
        string $placeholder,
        int $cvc,
        Date $due_date,
        int $user_id
    ): IAccount;
}
