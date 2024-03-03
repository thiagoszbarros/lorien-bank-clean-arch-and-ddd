<?php

declare(strict_types=1);

namespace App\Bussiness\Infra\Adapters;

use App\Bussiness\Application\Contracts\IGenerateRandomKey;
use App\Bussiness\Domain\ValueObjects\RandomKey;
use Ramsey\Uuid\Uuid;

class GenerateRandomKey implements IGenerateRandomKey
{
    public function generate(): RandomKey
    {
        return new RandomKey(value: Uuid::uuid4()->toString());
    }
}
