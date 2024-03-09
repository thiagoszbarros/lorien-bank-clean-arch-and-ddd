<?php

declare(strict_types=1);

namespace App\Bussiness\Domain\ValueObjects;

final readonly class AccessCode {
    private string $accessCode;

    public function __construct(string $accessCode) {
        if (strlen($accessCode) !== 6) {
            throw new \DomainException('PIN code access should have 6 digits.', 400);
        }

        $this->accessCode = $accessCode;
    }

    public function getValue(): string {
        return $this->accessCode;
    }
}