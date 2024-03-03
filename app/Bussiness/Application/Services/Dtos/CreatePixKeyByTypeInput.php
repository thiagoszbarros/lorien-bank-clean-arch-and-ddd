<?php

declare(strict_types=1);

namespace App\Bussiness\Application\Services\Dtos;

use App\Bussiness\Domain\Enums\PixKeyType;

class CreatePixKeyByTypeInput
{
    public function __construct(
        private PixKeyType $type,
        private ?string $value = null
    ) {

    }

    public function getType(): PixKeyType
    {
        return $this->type;
    }

    public function getValue(): ?string
    {
        return $this->value;
    }
}
