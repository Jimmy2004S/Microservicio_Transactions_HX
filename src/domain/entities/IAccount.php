<?php

namespace Src\Domain\Entities;

use Illuminate\Support\Facades\Date;

class IAccount
{
    public function __construct(
        private int $id,
        private float $balance,
        private int $number,
        private string $placeholder,
        private int $cvc,
        private Date $due_date,
        private int $user_id
    ) {}
}
