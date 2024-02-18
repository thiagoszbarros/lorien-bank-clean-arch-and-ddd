<?php

declare(strict_types=1);

namespace App\Bussiness\Domain\Enums;

enum PixKeyType: int
{
    case CPF = 1;
    case EMAIL = 2;
    case CELLPHONE = 3;
    case RANDOM = 4;
    case CNPJ = 5;
}
