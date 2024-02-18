<?php

declare(strict_types=1);

namespace App\Bussiness\Domain\ValueObjects;

final readonly class AccountNumber
{
    private string $value;

    public function __construct(Cpf $cpf)
    {
        $this->value = $cpf->getValue();
    }

    public function getValue(): string
    {
        return $this->value;
    }
}
