<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Src\Infraestructure\Persistence\Models\Account;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        Account::factory(10)->create();
    }
}
