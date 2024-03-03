<?php

declare(strict_types=1);

namespace App\Bussiness\Application\Contracts;

use App\Bussiness\Domain\ValueObjects\RandomKey;

interface IGenerateRandomKey
{
    public function generate(): RandomKey;
}
