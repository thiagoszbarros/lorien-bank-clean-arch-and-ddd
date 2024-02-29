<?php

declare(strict_types=1);

namespace App\Bussiness\Domain\Enums;

enum Messages: string
{
    case INVALID_PIX_KEY_TYPE_GIVEN = 'Invalid pix key type given. Accepted types: 1 - CPF, 2 - EMAIL, 3 - CELLPHONE, 4 - RANDOM';
    case PIX_KEY_SUCCESSESFULLY_REGISTERED = 'Pix Key successfully registered.';
    case FAILED_TO_REGISTER_KEY = 'Failed to register key.';
}
