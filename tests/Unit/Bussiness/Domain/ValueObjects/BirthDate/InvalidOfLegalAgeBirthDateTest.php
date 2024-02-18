<?php

declare(strict_types=1);

use App\Bussiness\Domain\ValueObjects\BirthDate;

it('should throw exception when invalid value format is given', function () {
    new BirthDate((new DateTimeImmutable())->format('Y-m-d'));
})->throws(DomainException::class, 'User must be at least 18 years old.', 400);
