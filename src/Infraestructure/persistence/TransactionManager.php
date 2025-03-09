<?php

namespace Src\Infraestructure\Persistence;

use Illuminate\Support\Facades\DB;

class TransactionManager
{
    public function transaction(callable $callback)
    {
        return DB::transaction($callback);
    }
}
