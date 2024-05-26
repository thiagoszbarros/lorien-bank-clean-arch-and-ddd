<?php

declare(strict_types=1);

namespace App\Repositories\Eloquent;

use App\Bussiness\Domain\Entities\CheckingAccount;
use App\Bussiness\Domain\Entities\PixKey;
use App\Bussiness\Domain\Repositories\IRegisterKey;

final readonly class RegisterKey implements IRegisterKey
{
    public function register(
        CheckingAccount $checkingAccount,
        PixKey $pixKey
    ): bool {
        return (bool) \App\Models\PixKey::create([
            'checking_account_id' => $checkingAccount->getId(),
            'type' => $pixKey->getType(),
            'key' => $pixKey->getKey(),
        ]);
    }
}
