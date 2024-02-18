<?php

declare(strict_types=1);

Arch('Bussiness/Domain/Enums')
    ->expect('App\Bussiness\Domain\Enums')
    ->toBeEnums()
    ->toBeIntBackedEnums();
