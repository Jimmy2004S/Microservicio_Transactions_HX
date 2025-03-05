<?php

namespace Src\Domain\Entities;

use Illuminate\Support\Facades\Date;

class ITransaction
{
    public function __construct(
        private int $id,
        private string $status,
        private string $type,
        private float $amount,
        private string $date,
        private int $from_account_id,
        private int $to_account_id
    ) {}


    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'status' => $this->status,
            'type' => $this->type,
            'amount' => $this->amount,
            'date' => $this->date,
            'from_account_id' => $this->from_account_id,
            'to_account_id' => $this->to_account_id,
        ];
    }
}
