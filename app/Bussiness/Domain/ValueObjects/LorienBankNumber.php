<?php

declare(strict_types=1);

namespace App\Bussiness\Domain\ValueObjects;

class LorienBankNumber
{
    private int $value;

    public function __construct()
    {
        $this->value = 2901;
    }

    public function getValue(): int
    {
        return $this->value;
    }
}
