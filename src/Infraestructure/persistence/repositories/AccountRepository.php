<?php

namespace Src\Infraestructure\persistence\repositories;

use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Date;
use Src\Domain\Entities\Account;
use Src\Domain\Entities\IAccount;
use Src\Domain\Repositories\IAccountRepository;
use Src\Infraestructure\Persistence\Models\Account as ModelsAccount;

class AccountRepository implements IAccountRepository
{
    public function createAccount(
        float $balance,
        int $number,
        string $placeholder,
        string $cvc,
        string $due_date,
        int $user_id
    ) {

        return ModelsAccount::create([
            'balance' => $balance,
            'number' => $number,
            'cvc' => $cvc,
            'placeholder' => $placeholder,
            'due_date' => $due_date,
            'user_id' => $user_id,
        ]);
    }


    public function where(string $param, string $value)
    {
        return ModelsAccount::where($param, $value)->get()->map(function ($account) {
            return new IAccount(
                $account->id,
                $account->balance,
                $account->number,
                $account->placeholder,
                Crypt::decryptString($account->cvc),
                $account->due_date,
                $account->user_id,
            );
        });
    }
}
