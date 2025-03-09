<?php

namespace Src\Aplication\Services;

use Exception;
use Src\Domain\Repositories\IAccountRepository;
use Src\Domain\Repositories\ITransactionRepository;
use Src\Domain\Services\ITransactionService;
use Src\Infraestructure\Api\EmailService as ApiEmailService;
use Src\Infraestructure\Api\LogService;
use Src\Infraestructure\Persistence\TransactionManager;

class TransactionService implements ITransactionService
{
    public function __construct(
        private ITransactionRepository $transactionRepository,
        private IAccountRepository $accountRepository,
        private TransactionManager $transactionManager,
    ) {}

    public function sendTransaction($amount, $user_id, $user_email,  $to_account_number)
    {
        try {
            return $this->transactionManager->transaction(function () use ($amount, $user_id, $user_email, $to_account_number) {

                $from_account = $this->accountRepository->where('user_id', $user_id)->first();

                $to_account = $this->accountRepository->where('number', $to_account_number)->first();

                if (!$from_account || !$to_account) {
                    throw new Exception('Una o ambas cuentas no existen');
                }


                // Validar saldo suficiente
                if ($from_account['balance'] < $amount) {
                    throw new Exception('Saldo insuficiente');
                }

                // Actualizar saldo de cuentas
                $this->accountRepository->update($from_account['id'], [
                    'balance' => $from_account['balance'] - $amount
                ]);

                $this->accountRepository->update($to_account['id'], [
                    'balance' => $to_account['balance'] + $amount
                ]);

                // Registrar transacción
                $transaction = $this->transactionRepository->createTransaction(
                    'outcome',
                    $amount,
                    $from_account['id'],
                    $to_account['id'],
                    'succesfull'
                );


                if (!$transaction) {
                    throw new Exception('Error al crear la transacción');
                }

                // Enviar correo
                ApiEmailService::send($user_email, 'transaction', [
                    'amount' => $amount,
                    'type' => 'income'
                ]);

                return $transaction->toArray();
            });
        } catch (Exception $e) {
            dd($e->getMessage());
            // LogService::store('transaction', 'post', $e->getMessage());
            throw new Exception();
        }
    }
}
