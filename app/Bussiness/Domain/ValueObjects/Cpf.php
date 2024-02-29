<?php

declare(strict_types=1);

namespace App\Bussiness\Domain\ValueObjects;

final readonly class Cpf
{
    private string $value;

    public function __construct(
        string $value
    ) {
        if ($this->validate($value) === false) {
            throw new \DomainException('Invalid cpf.');
        }

        $this->value = $value;
    }

    private function validate($value): bool
    {
        if (strlen($value) != 11) {
            return false;
        }

        if (preg_match('/(\d)\1{10}/', $value)) {
            return false;
        }

        for ($t = 9; $t < 11; $t++) {
            for ($d = 0, $c = 0; $c < $t; $c++) {
                $d += $value[$c] * (($t + 1) - $c);
            }
            $d = ((10 * $d) % 11) % 10;
            if ($value[$c] != $d) {
                return false;
            }
        }

        return true;
    }

    public function getValue(): string
    {
        return $this->value;
    }
}
