<?php

declare(strict_types=1);

namespace App\Bussiness\Application\Services;

use App\Bussiness\Application\Contracts\IGenerateRandomKey;
use App\Bussiness\Application\Services\Dtos\CreatePixKeyByTypeInput;
use App\Bussiness\Domain\Enums\PixKeyType;
use App\Bussiness\Domain\ValueObjects\Cellphone;
use App\Bussiness\Domain\ValueObjects\Cpf;
use App\Bussiness\Domain\ValueObjects\Email;
use App\Bussiness\Domain\ValueObjects\RandomKey;

class CreatePixKeyByType
{
    public function __construct(
        private readonly IGenerateRandomKey $randomKeyGenerator,
    ) {
    }

    public function handle(CreatePixKeyByTypeInput $input): Cellphone|Cpf|Email|RandomKey
    {
        return match ($input->getType()) {
            PixKeyType::CPF => new Cpf($input->getValue()),
            PixKeyType::EMAIL => new Email($input->getValue()),
            PixKeyType::CELLPHONE => new Cellphone($input->getValue()),
            PixKeyType::RANDOM => $this->randomKeyGenerator->generate(),
        };
    }
}
