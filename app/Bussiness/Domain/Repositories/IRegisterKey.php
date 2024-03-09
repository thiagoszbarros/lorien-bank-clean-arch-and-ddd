<?php

declare(strict_types=1);

namespace App\Bussiness\Domain\Repositories;

use App\Bussiness\Domain\Entities\CheckingAccount\CheckingAccount;
use App\Bussiness\Domain\Entities\PixKey;

interface IRegisterKey
{
    public function register(
        CheckingAccount $checkkingAccount,
        PixKey $pixKey
    ): bool;
}
