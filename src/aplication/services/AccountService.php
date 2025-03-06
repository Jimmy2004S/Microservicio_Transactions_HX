<?php

namespace Src\aplication\services;

use Illuminate\Support\Facades\Hash;
use Src\Domain\Entities\IAccount;
use Src\Domain\Repositories\IAccountRepository;
use Src\domain\services\IAccountService;

class AccountService implements IAccountService
{


    public function __construct(private IAccountRepository $accountRepository) {}

    public function createAccount($placeholder, $user_id)
    {

        $balance = 0;
        $cvc = $this->generateCVC();
        $hashedCVC = Hash::make($cvc);
        $number = $this->generateAccountNumber($user_id);
        $due_date = $this->generateDueDate();
        $account = $this->accountRepository->createAccount($balance, $number, $placeholder, $hashedCVC, $due_date, $user_id);

        if (!$account) return null;

        return $account;
    }


    function generateAccountNumber($userId)
    {
        $prefix = '1000'; // Prefijo del banco
        return $prefix . str_pad($userId, 10, '0', STR_PAD_LEFT);
    }

    function generateCVC()
    {
        return str_pad(random_int(0, 999), 3, '0', STR_PAD_LEFT);
    }

    function generateDueDate()
    {
        return now()->addYears(5)->format('Y-m-d'); // Fecha de vencimiento en 5 años
    }
}
