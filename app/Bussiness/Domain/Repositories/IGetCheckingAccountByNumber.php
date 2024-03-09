<?php

declare(strict_types=1);

namespace App\Bussiness\Domain\Repositories;

use App\Bussiness\Domain\Entities\CheckingAccount\CheckingAccount;
use App\Bussiness\Domain\ValueObjects\AccountNumber;

interface IGetCheckingAccountByNumber
{
    public function get(AccountNumber $accountNumber): ?CheckingAccount;
}
