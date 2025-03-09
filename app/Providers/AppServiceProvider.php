<?php

namespace App\Providers;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\ServiceProvider;
use Src\Aplication\Services\TransactionService;
use Src\Domain\Repositories\IAccountRepository;
use Src\Domain\Repositories\ITransactionRepository;
use Src\domain\services\ITransactionService;
use Src\Infraestructure\persistence\repositories\AccountRepository;
use Src\Infraestructure\persistence\repositories\TransactionRepository;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(ITransactionRepository::class, TransactionRepository::class);
        $this->app->bind(IAccountRepository::class, AccountRepository::class);
        $this->app->bind(ITransactionService::class, TransactionService::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Factory::guessFactoryNamesUsing(function ($modelName) {
            return 'Database\Factories\\' . class_basename($modelName) . 'Factory';
        });
    }
}
