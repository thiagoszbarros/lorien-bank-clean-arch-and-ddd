<?php

declare(strict_types=1);

Arch('Bussiness/Domain/ValueObjects')
    ->expect('App\Bussiness\Domain\ValueObjects')
    ->toBeClasses()
    ->toBeFinal()
    ->toBeReadonly();
