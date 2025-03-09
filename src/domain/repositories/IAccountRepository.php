<?php

namespace Src\Domain\Repositories;

use Illuminate\Support\Facades\Date;
use Src\Domain\Entities\Account;
use Src\Domain\Entities\IAccount;
use Src\Infraestructure\Persistence\Models\Account as ModelsAccount;

interface IAccountRepository
{
    public function createAccount(
        float $balance,
        int $number,
        string $placeholder,
        string $cvc,
        string $due_date,
        int $user_id
    );

    public function where(string $param, string $value);

    public function find(int $id);

    public function update(int $id, array $data);
}
