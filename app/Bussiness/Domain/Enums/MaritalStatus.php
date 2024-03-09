<?php

declare(strict_types=1);

namespace App\Bussiness\Domain\Enums;

enum MaritalStatus: int
{
    case SINGLE = 1;
    case MARRIED = 2;
    case DIVORCED = 3;
    case WIDOWED = 4;
}
