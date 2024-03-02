<?php

declare(strict_types=1);

Arch('Models')
    ->expect('App\Models')
    ->toUseStrictTypes()
    ->toBeClasses();
