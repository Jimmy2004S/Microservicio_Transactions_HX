<?php

namespace Src\Infraestructure\Persistence\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Account extends Model
{

    use HasFactory;

    protected $table = 'accounts';


    protected $fillable = ['user_id', 'balance', 'placeholder', 'due_date', 'number', 'cvc'];

    public function transactions(): HasMany
    {
        return $this->hasMany(Transaction::class);
    }
}
