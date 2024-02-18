<?php

declare(strict_types=1);

use App\Bussiness\Domain\ValueObjects\BirthDate;

it('should throw exception when invalid of legal age birthdate value is given', function () {
    new BirthDate('2000/01/01');
})->throws(DomainException::class, 'Birth date should have format Y-m-d. ex: 2021-01-29', 400);
