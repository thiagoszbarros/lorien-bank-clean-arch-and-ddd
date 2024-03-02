<?php

declare(strict_types=1);

namespace App\Bussiness\Application\UseCases;

use App\Bussiness\Application\Dtos\RegisterKeyInput;
use App\Bussiness\Application\Dtos\RegisterKeyOutput;
use App\Bussiness\Domain\Entities\PixKey;
use App\Bussiness\Domain\Enums\Messages;
use App\Bussiness\Domain\Enums\PixKeyType;
use App\Bussiness\Domain\Repositories\IGetPixKeyByAccountNumberAndType;
use App\Bussiness\Domain\Repositories\IRegisterKey;
use App\Bussiness\Domain\ValueObjects\AccountNumber;
use App\Bussiness\Domain\ValueObjects\Cellphone;
use App\Bussiness\Domain\ValueObjects\Cpf;
use App\Bussiness\Domain\ValueObjects\Email;
use App\Bussiness\Domain\ValueObjects\RandomKey;

final readonly class RegisterKey
{
    public function __construct(
        private IGetPixKeyByAccountNumberAndType $getPixKeyByAccountNumberAndTypeRepo,
        private IRegisterKey $registerKeyRepo,
    ) {
    }

    public function handle(RegisterKeyInput $input): RegisterKeyOutput
    {
        $pixKeyType = PixKeyType::tryFrom($input->getKeyType());

        if ($pixKeyType === null || $pixKeyType === PixKeyType::CNPJ) {
            return new RegisterKeyOutput(false, Messages::INVALID_PIX_KEY_TYPE_GIVEN);
        }

        $accountNumber = new AccountNumber(new Cpf($input->getAccountNumber()));

        $keyTypeAlrearyExists = $this->getPixKeyByAccountNumberAndTypeRepo->get($accountNumber, $pixKeyType);

        if ($keyTypeAlrearyExists instanceof PixKey) {
            return new RegisterKeyOutput(
                success: false,
                message: Messages::KEY_TYPE_ALREADY_REGISTERED
            );
        }

        $key = match ($pixKeyType) {
            PixKeyType::CPF => new Cpf($input->getKey()),
            PixKeyType::EMAIL => new Email($input->getKey()),
            PixKeyType::CELLPHONE => new Cellphone($input->getKey()),
            PixKeyType::RANDOM => new RandomKey(),
        };

        $pixKey = PixKey::reset()
            ->setKey($key)
            ->setType($pixKeyType)
            ->setAccountNumber($accountNumber);

        return $this->registerKeyRepo->register($pixKey) === true
            ? new RegisterKeyOutput(true, Messages::PIX_KEY_SUCCESSESFULLY_REGISTERED)
            : new RegisterKeyOutput(false, Messages::FAILED_TO_REGISTER_KEY);
    }
}
