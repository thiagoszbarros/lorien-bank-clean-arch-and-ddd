<?php

declare(strict_types=1);

namespace App\Bussiness\Domain\ValueObjects;

final readonly class BirthDate
{
    private const int LEGAL_AGE = 18;
    private \DateTimeImmutable $value;

    public function __construct(string $value)
    {
        $birthDate = $this->formatCheck($value);

        if ($birthDate === false) {
            throw new \DomainException('Birth date should have format Y-m-d. ex: 2021-01-29', 400);
        }

        if ($this->legalAgeCheck($birthDate) === false) {
            throw new \DomainException('User must be at least 18 years old.', 400);
        }

        $this->value = $birthDate;
    }

    private function formatCheck(string $value): false|\DateTimeImmutable
    {
        return \DateTimeImmutable::createFromFormat('Y-m-d', $value, new \DateTimeZone('America/Fortaleza'));
    }

    private function legalAgeCheck(\DateTimeImmutable $birthDate): bool
    {
        $now = (new \DateTimeImmutable('now', new \DateTimeZone('America/Fortaleza')));
        $age = $birthDate->diff($now)->y;

        return $age >= self::LEGAL_AGE;
    }

    public function getValue(): \DateTimeImmutable
    {
        return $this->value;
    }
}
