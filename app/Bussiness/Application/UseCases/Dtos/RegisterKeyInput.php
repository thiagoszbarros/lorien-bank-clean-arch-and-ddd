<?php

declare(strict_types=1);

namespace App\Bussiness\Application\UseCases\Dtos;

final readonly class RegisterKeyInput
{
    public function __construct(
        private int $keyType,
        private ?string $key,
        private string $accountNumber,
    ) {
    }

    public function getKeyType(): int
    {
        return $this->keyType;
    }

    public function getKey(): ?string
    {
        return $this->key;
    }

    public function getAccountNumber(): string
    {
        return $this->accountNumber;
    }
}
