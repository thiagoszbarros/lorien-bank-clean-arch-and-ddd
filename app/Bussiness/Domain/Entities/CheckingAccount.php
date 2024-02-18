<?php

declare(strict_types=1);

namespace App\Bussiness\Domain\Entities;

use App\Bussiness\Domain\ValueObjects\AccountNumber;
use App\Bussiness\Domain\ValueObjects\LorienBankNumber;

final readonly class CheckingAccount
{
    private LorienBankNumber $bankNumber;

    private int $branch;

    private AccountNumber $number;

    private int $digit;

    private function __construct()
    {
        $this->bankNumber = new LorienBankNumber();
    }

    public static function reset(): static
    {
        return new CheckingAccount();
    }

    public function getBankNumber(): int
    {
        return $this->bankNumber->getValue();
    }

    public function getBranch(): int
    {
        return $this->branch;
    }

    public function setBranch(int $branch): static
    {
        $this->branch = $branch;

        return $this;
    }

    public function getNumber(): AccountNumber
    {
        return $this->number;
    }

    public function setNumber(AccountNumber $number): static
    {
        $this->number = $number;

        return $this;
    }

    public function getDigit(): int
    {
        return $this->digit;
    }

    public function setDigit(int $digit): static
    {
        $this->digit = $digit;

        return $this;
    }
}
