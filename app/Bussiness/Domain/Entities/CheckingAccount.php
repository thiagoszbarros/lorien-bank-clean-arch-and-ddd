<?php

declare(strict_types=1);

namespace App\Bussiness\Domain\Entities;

use App\Bussiness\Domain\ValueObjects\AccessCode;
use App\Bussiness\Domain\ValueObjects\AccountNumber;
use App\Bussiness\Domain\ValueObjects\LorienBankNumber;

final readonly class CheckingAccount
{
    private int $id;

    private LorienBankNumber $bankNumber;

    private string $branch;

    private AccountNumber $number;

    private int $digit;

    private AccessCode $accessCode;

    private function __construct()
    {
        $this->bankNumber = new LorienBankNumber();
    }

    public static function reset(): static
    {
        return new CheckingAccount();
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): static
    {
        $this->id = $id;

        return $this;
    }

    public function getBankNumber(): string
    {
        return $this->bankNumber->getValue();
    }

    public function getBranch(): string
    {
        return $this->branch;
    }

    public function setBranch(string $branch): static
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

    public function getAccessCode(): AccessCode
    {
        return $this->accessCode;
    }

    public function setAccessCode(AccessCode $accessCode): static
    {
        $this->accessCode = $accessCode;

        return $this;
    }
}
