<?php

declare(strict_types=1);

namespace App\Repositories\Eloquent;

use App\Bussiness\Domain\Entities\CheckingAccount\CheckingAccount;
use App\Bussiness\Domain\Entities\PixKey;
use App\Bussiness\Domain\Enums\PixKeyType;
use App\Bussiness\Domain\Repositories\IGetPixKeyByCheckingAccountIdAndType;

final readonly class GetPixKeyByCheckingAccountIdAndType implements IGetPixKeyByCheckingAccountIdAndType
{
    public function get(CheckingAccount $checkingAccount, PixKeyType $type): ?PixKey
    {
        $pixKey = \App\Models\PixKey::whereCheckingAccountIdAndType(
            $checkingAccount->getId(),
            $type->value
        )->first();

        if ($pixKey === null) {
            return null;
        }

        return PixKey::reset();
    }
}
