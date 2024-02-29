<?php

use App\Bussiness\Application\Dtos\RegisterKeyInput;
use App\Bussiness\Application\UseCases\RegisterKey;
use App\Bussiness\Domain\Repositories\IRegisterKey;

it('should register pix key type cpf successfully', function (): void {
    $this->registerKeyRepo = Mockery::mock(IRegisterKey::class);

    $this->useCase = new RegisterKey($this->registerKeyRepo);

    $inputBoundary = new RegisterKeyInput(
        1,
        '06806573398',
        '06806573398'
    );

    $this->registerKeyRepo
        ->shouldReceive('register')
        ->andReturn(true);

    $result = $this->useCase->handle($inputBoundary);

    expect($result->getMessage())->toBe('Pix Key successfully registered.');
});
