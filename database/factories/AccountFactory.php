<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Src\Infraestructure\Persistence\Models\Account;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Src\\Infraestructure\\Persistence\\Models\\Account>
 */
class AccountFactory extends Factory
{

    protected $model = Account::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'balance' => fake()->randomFloat(2, 100, 10000),
            'number' => fake()->unique()->numberBetween(100000, 999999),
            'cvc' => fake()->numerify('###'),
            'placeholder' => fake()->name(),
            'due_date' => fake()->date(),
            'user_id' => 1
        ];
    }
}
