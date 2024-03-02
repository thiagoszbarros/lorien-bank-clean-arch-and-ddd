<?php

use App\Bussiness\Application\Dtos\RegisterKeyInput;
use App\Bussiness\Application\UseCases\RegisterKey;
use App\Bussiness\Domain\Entities\CheckingAccount;
use App\Bussiness\Domain\Enums\PixKeyType;
use App\Bussiness\Domain\Repositories\IGetCheckingAccountByNumber;
use App\Bussiness\Domain\Repositories\IGetPixKeyByCheckingAccountIdAndType;
use App\Bussiness\Domain\Repositories\IRegisterKey;

it('should registrate pix key type random successfully', function (): void {
    $this->getCheckingAccountByNumberRepo = Mockery::mock(IGetCheckingAccountByNumber::class);

    $this->getPixKeyByCheckingAccountIdAndTypeRepo = Mockery::mock(IGetPixKeyByCheckingAccountIdAndType::class);

    $this->registerKeyRepo = Mockery::mock(IRegisterKey::class);

    $this->useCase = new RegisterKey(
        getCheckingAccountByNumberRepo: $this->getCheckingAccountByNumberRepo,
        getPixKeyByCheckingAccountIdAndTypeRepo: $this->getPixKeyByCheckingAccountIdAndTypeRepo,
        registerKeyRepo: $this->registerKeyRepo,
    );

    $inputBoundary = new RegisterKeyInput(
        PixKeyType::RANDOM->value,
        null,
        '06806573398'
    );

    $this->getCheckingAccountByNumberRepo
        ->shouldReceive('get')
        ->andReturn(CheckingAccount::reset());

    $this->getPixKeyByCheckingAccountIdAndTypeRepo
        ->shouldReceive('get')
        ->andReturn(null);

    $this->registerKeyRepo
        ->shouldReceive('register')
        ->andReturn(true);

    $result = $this->useCase->handle($inputBoundary);

    expect($result->getMessage())->toBe('Pix Key successfully registered.');
});
