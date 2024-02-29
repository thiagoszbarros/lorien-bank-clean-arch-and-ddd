<?php

declare(strict_types=1);

namespace App\Bussiness\Domain\ValueObjects;

final readonly class Cellphone
{
    private string $value;

    public function __construct(string $value)
    {
        if ($this->sizeCheck($value) === false) {
            throw new \DomainException('Cellphone number with DDD should have 11 digits. ex: 99912345678');
        }

        if ($this->ninthDigitCheck($value) === false) {
            throw new \DomainException('Cellphone number should start with character 9. ex: 912345678');
        }

        $this->value = $value;
    }

    private function sizeCheck(string $value): bool
    {
        return strlen($value) === 11;
    }

    private function ninthDigitCheck(string $value): bool
    {
        return str_starts_with(substr($value, -9), '9');
    }

    public function getValue(): string
    {
        return $this->value;
    }
}
