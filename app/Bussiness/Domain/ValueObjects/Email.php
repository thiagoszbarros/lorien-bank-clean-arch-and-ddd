<?php

declare(strict_types=1);

namespace App\Bussiness\Domain\ValueObjects;

final readonly class Email
{
    private string $value;

    public function __construct(
        string $value
    ) {
        if (! filter_var($value, FILTER_VALIDATE_EMAIL)) {
            throw new \DomainException('Invalid email.');
        }

        $this->value = $value;
    }

    public function getValue(): string
    {
        return $this->value;
    }
}
