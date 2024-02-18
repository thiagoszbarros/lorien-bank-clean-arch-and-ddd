<?php

declare(strict_types=1);

Arch('Bussiness/Domain/Entities')
    ->expect('App\Bussiness\Domain\Entities')
    ->toBeClasses()
    ->toBeFinal()
    ->toBeReadonly();
