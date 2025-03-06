<?php

namespace Src\domain\services;

use Src\Domain\Entities\IAccount;

interface IAccountService
{
    public function createAccount($placeholder, $user_id);
}
