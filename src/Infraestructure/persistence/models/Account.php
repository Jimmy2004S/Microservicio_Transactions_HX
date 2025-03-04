<?php

namespace Src\Infraestructure\Persistence\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Account extends Model
{
    protected $fillable = ['user_id', 'balance', 'placeholder', 'due_date', 'number'];

    public function transactions(): HasMany
    {
        return $this->hasMany(Transaction::class);
    }
}
