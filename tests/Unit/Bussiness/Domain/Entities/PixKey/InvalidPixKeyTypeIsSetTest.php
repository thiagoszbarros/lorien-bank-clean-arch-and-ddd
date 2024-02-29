<?php

use App\Bussiness\Domain\Entities\PixKey;
use App\Bussiness\Domain\Enums\PixKeyType;

it('should throw exception when invalid pixkey type is set', function () {
    PixKey::reset()
        ->setType(PixKeyType::CNPJ);
})->throws(
    DomainException::class,
    'Invalid pix key type. Internal user can not have a pix key of type CNPJ.',
    400
);
