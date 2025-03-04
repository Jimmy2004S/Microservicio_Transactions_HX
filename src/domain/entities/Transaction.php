<?php

namespace Src\Domain\Entities;

use Illuminate\Support\Facades\Date;

class Transaction
{
    public function __construct(
        private int $id,
        private string $status,
        private string $type,
        private float $amount,
        private Date $date,
        private int $from_account_id,
        private int $to_account_id
    ) {}
}
