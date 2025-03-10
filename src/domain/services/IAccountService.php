<?php

namespace Src\domain\services;

use Src\Domain\Entities\IAccount;

interface IAccountService
{
    public function createAccount($placeholder, $user_id);
    public function getAccountByNumber(int $number);
    public function getAccountById(int $id);
}
