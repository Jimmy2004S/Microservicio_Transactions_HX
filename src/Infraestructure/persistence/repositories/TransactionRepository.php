<?php

namespace Src\Infraestructure\persistence\repositories;

use Carbon\Carbon;
use Illuminate\Support\Facades\Date;
use Src\Domain\Entities\ITransaction;
use Src\Domain\Repositories\ITransactionRepository;
use Src\Infraestructure\Persistence\Models\Transaction as ModelsTransaction;

class TransactionRepository implements ITransactionRepository
{


    public function createTransaction(
        string $type,
        float $amount,
        int $from_account_id,
        int $to_account_id,
        string $status
    ): ITransaction {

        $transaction = ModelsTransaction::create([
            'type'              => $type,
            'status'            => $status,
            'amount'            => $amount,
            'from_account_id'   => $from_account_id,
            'to_account_id'     => $to_account_id
        ]);

        return new ITransaction(
            $transaction->id,
            $transaction->status,
            $transaction->type,
            $transaction->amount,
            $transaction->created_at->format('Y-m-d H:i:s'),
            $transaction->from_account_id,
            $transaction->to_account_id
        );
    }
}
