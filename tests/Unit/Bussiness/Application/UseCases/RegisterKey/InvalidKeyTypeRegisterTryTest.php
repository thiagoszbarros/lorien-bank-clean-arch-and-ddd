<?php

use App\Bussiness\Application\Dtos\RegisterKeyInput;
use App\Bussiness\Application\UseCases\RegisterKey;
use App\Bussiness\Domain\Repositories\IRegisterKey;

it('should return invalid pix key type error message', function (): void {
    $this->registerKeyRepo = Mockery::mock(IRegisterKey::class);

    $this->useCase = new RegisterKey($this->registerKeyRepo);

    $inputBoundary = new RegisterKeyInput(
        5,
        '068065733981234',
        '06806573398'
    );

    $result = $this->useCase->handle($inputBoundary);

    expect($result->getMessage())->toBe('Invalid pix key type given. Accepted types: 1 - CPF, 2 - EMAIL, 3 - CELLPHONE, 4 - RANDOM');
});
