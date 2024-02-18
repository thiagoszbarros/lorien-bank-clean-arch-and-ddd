<?php

declare(strict_types=1);

namespace App\Bussiness\Domain\ValueObjects;

final readonly class Cellphone
{
    private string $value;

    public function __construct(string $value)
    {
        if ($this->validate($value) === false) {
            throw new \DomainException('Invalid cellphone number.');
        }

        $this->value = $value;
    }

    private function validate(string $value): bool
    {
        $value = preg_replace('/[^0-9]/', '', $value);

        return strlen($value) !== 11 || ! str_starts_with($value, '9');
    }

    public function getValue(): string
    {
        return $this->value;
    }
}
