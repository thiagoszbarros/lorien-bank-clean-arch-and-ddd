<?php

declare(strict_types=1);

namespace App\Bussiness\Domain\ValueObjects;

final readonly class Cellphone
{
    private string $cellphone;

    public function __construct(string $cellphone)
    {
        if ($this->validate($cellphone) === false) {
            throw new \DomainException('Invalid cellphone number.');
        }

        $this->cellphone = $cellphone;
    }

    private function validate(string $cellphone): bool
    {
        $cellphone = preg_replace('/[^0-9]/', '', $cellphone);

        return strlen($cellphone) !== 11 || ! str_starts_with($cellphone, '9');
    }

    public function __toString(): string
    {
        return $this->cellphone;
    }
}
