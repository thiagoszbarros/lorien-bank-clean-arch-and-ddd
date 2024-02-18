<?php

declare(strict_types=1);

namespace App\Bussiness\Domain\ValueObjects;

final readonly class RandomKey
{
    private string $value;

    public function __construct()
    {
        $this->value = $this->generate();
    }

    private function generate(): string
    {
        $firstPart = random_bytes(8);
        $secondPart = random_bytes(4);
        $thirdPart = random_bytes(4);
        $fourthPart = random_bytes(4);
        $fifthPart = random_bytes(12);

        return "$firstPart-$secondPart-$thirdPart-$fourthPart-$fifthPart";
    }

    public function getValue(): string
    {
        return $this->value;
    }
}
