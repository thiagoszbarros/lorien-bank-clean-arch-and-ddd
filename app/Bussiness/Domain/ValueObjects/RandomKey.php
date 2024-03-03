<?php

declare(strict_types=1);

namespace App\Bussiness\Domain\ValueObjects;

final readonly class RandomKey
{
    private string $value;

    public function __construct(
        string $value
    ) {
        $this->value = $value;
    }

    public function getValue(): string
    {
        return $this->value;
    }
}
