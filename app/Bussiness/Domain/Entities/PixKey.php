<?php

declare(strict_types=1);

namespace App\Bussiness\Domain\Entities;

use App\Bussiness\Domain\Enums\PixKeyType;
use App\Bussiness\Domain\ValueObjects\AccountNumber;
use App\Bussiness\Domain\ValueObjects\Cellphone;
use App\Bussiness\Domain\ValueObjects\Cpf;
use App\Bussiness\Domain\ValueObjects\Email;
use App\Bussiness\Domain\ValueObjects\RandomKey;

final readonly class PixKey
{
    private PixKeyType $type;

    private Cpf|Email|Cellphone|RandomKey $key;

    private AccountNumber $accountNumber;

    private function __construct()
    {
    }

    public static function reset(): static
    {
        return new PixKey();
    }

    public function getKey(): string
    {
        return $this->key->getValue();
    }

    public function setKey(Cpf|Email|Cellphone|RandomKey $key): static
    {
        $this->key = $key;

        return $this;
    }

    public function getType(): PixKeyType
    {
        return $this->type;
    }

    public function setType(PixKeyType $type): static
    {
        if ($type === PixKeyType::CNPJ) {
            throw new \DomainException("Invalid pix key type. Internal user can not have a pix key of type $type->name.", 400);
        }

        $this->type = $type;

        return $this;
    }

    public function getAccountNumber(): AccountNumber
    {
        return $this->accountNumber;
    }

    public function setAccountNumber(AccountNumber $accountNumber): static
    {
        $this->accountNumber = $accountNumber;

        return $this;
    }
}
