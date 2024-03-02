<?php

declare(strict_types=1);

namespace App\Repositories\Eloquent;

use App\Bussiness\Domain\Entities\CheckingAccount;
use App\Bussiness\Domain\Repositories\IGetCheckingAccountByNumber;
use App\Bussiness\Domain\ValueObjects\AccountNumber;

final readonly class GetCheckingAccountByNumber implements IGetCheckingAccountByNumber
{
    public function get(AccountNumber $accountNumber): ?CheckingAccount
    {
        $checkingAccount = \App\Models\CheckingAccount::whereNumber(
            $accountNumber->getValue()
        )->first();

        if ($checkingAccount === null) {
            return null;
        }

        return CheckingAccount::reset()
            ->setId($checkingAccount->id);
    }
}
