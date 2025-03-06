<?php

namespace Src\Domain\Entities;

use Illuminate\Support\Facades\Date;

class IAccount
{
    public function __construct(
        private float $balance,
        private int $number,
        private string $placeholder,
        private int $cvc,
        private string $due_date,
        private int $user_id
    ) {}
}
