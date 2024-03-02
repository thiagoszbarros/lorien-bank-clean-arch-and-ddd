<?php

declare(strict_types=1);

namespace App\Bussiness\Domain\Repositories;

use App\Bussiness\Domain\Entities\CheckingAccount;
use App\Bussiness\Domain\Entities\PixKey;
use App\Bussiness\Domain\Enums\PixKeyType;

interface IGetPixKeyByCheckingAccountIdAndType
{
    public function get(
        CheckingAccount $checkingAccount,
        PixKeyType $type
    ): ?PixKey;
}
