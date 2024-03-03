<?php

declare(strict_types=1);

namespace App\Bussiness\Application\UseCases;

use App\Bussiness\Application\Services\CreatePixKeyByType;
use App\Bussiness\Application\Services\Dtos\CreatePixKeyByTypeInput;
use App\Bussiness\Application\UseCases\Dtos\RegisterKeyInput;
use App\Bussiness\Application\UseCases\Dtos\RegisterKeyOutput;
use App\Bussiness\Domain\Entities\PixKey;
use App\Bussiness\Domain\Enums\Messages;
use App\Bussiness\Domain\Enums\PixKeyType;
use App\Bussiness\Domain\Repositories\IGetCheckingAccountByNumber;
use App\Bussiness\Domain\Repositories\IGetPixKeyByCheckingAccountIdAndType;
use App\Bussiness\Domain\Repositories\IRegisterKey;
use App\Bussiness\Domain\ValueObjects\AccountNumber;
use App\Bussiness\Domain\ValueObjects\Cpf;

final readonly class RegisterKey
{
    public function __construct(
        private IGetCheckingAccountByNumber $getCheckingAccountByNumberRepo,
        private IGetPixKeyByCheckingAccountIdAndType $getPixKeyByCheckingAccountIdAndTypeRepo,
        private CreatePixKeyByType $createPixKeyByType,
        private IRegisterKey $registerKeyRepo,
    ) {
    }

    public function handle(RegisterKeyInput $input): RegisterKeyOutput
    {
        $pixKeyType = PixKeyType::tryFrom(value: $input->getKeyType());

        if ($pixKeyType === null || $pixKeyType === PixKeyType::CNPJ) {
            return new RegisterKeyOutput(
                success: false,
                message: Messages::INVALID_PIX_KEY_TYPE_GIVEN
            );
        }

        $accountNumber = new AccountNumber(
            cpf: new Cpf(
                value: $input->getAccountNumber()
            )
        );

        $checkingAccount = $this
            ->getCheckingAccountByNumberRepo
            ->get(accountNumber: $accountNumber);

        if ($checkingAccount === null) {
            return new RegisterKeyOutput(
                success: false,
                message: Messages::CHECKING_ACCOUNT_NOT_FOUND
            );
        }

        $keyTypeAlrearyExists = $this
            ->getPixKeyByCheckingAccountIdAndTypeRepo
            ->get(
                checkingAccount: $checkingAccount,
                type: $pixKeyType
            );

        if ($keyTypeAlrearyExists instanceof PixKey) {
            return new RegisterKeyOutput(
                success: false,
                message: Messages::KEY_TYPE_ALREADY_REGISTERED
            );
        }

        $key = $this->createPixKeyByType->handle(new CreatePixKeyByTypeInput($pixKeyType, $input->getKey()));

        $pixKey = PixKey::reset()
            ->setKey($key)
            ->setType($pixKeyType)
            ->setAccountNumber($accountNumber);

        return $this
            ->registerKeyRepo
            ->register($checkingAccount, $pixKey) === true ?
            new RegisterKeyOutput(
                success: true,
                message: Messages::PIX_KEY_SUCCESSESFULLY_REGISTERED
            ) :
            new RegisterKeyOutput(
                success: false,
                message: Messages::FAILED_TO_REGISTER_KEY
            );
    }
}
