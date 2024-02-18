<?php

declare(strict_types=1);

namespace App\Bussiness\Domain\ValueObjects;

final readonly class AccountNumber
{
    private string $number;

    public function __construct(Cpf $cpf)
    {
        $this->number = $cpf->__toString();
    }

    public function __toString(): string
    {
        return $this->number;
    }
}
