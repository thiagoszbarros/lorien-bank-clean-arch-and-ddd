<?php

use App\Bussiness\Application\Services\CreatePixKeyByType;
use App\Bussiness\Application\UseCases\Dtos\RegisterKeyInput;
use App\Bussiness\Application\UseCases\RegisterKey;
use App\Bussiness\Domain\Entities\CheckingAccount;
use App\Bussiness\Domain\Entities\PixKey;
use App\Bussiness\Domain\Enums\PixKeyType;
use App\Bussiness\Domain\Repositories\IGetCheckingAccountByNumber;
use App\Bussiness\Domain\Repositories\IGetPixKeyByCheckingAccountIdAndType;
use App\Bussiness\Domain\Repositories\IRegisterKey;

it('should return failed to register key error message', function (): void {
    $this->getCheckingAccountByNumberRepo = Mockery::mock(IGetCheckingAccountByNumber::class);

    $this->getPixKeyByCheckingAccountIdAndTypeRepo = Mockery::mock(IGetPixKeyByCheckingAccountIdAndType::class);

    $this->createPixKeyByType = Mockery::mock(CreatePixKeyByType::class);

    $this->registerKeyRepo = Mockery::mock(IRegisterKey::class);

    $this->useCase = new RegisterKey(
        getCheckingAccountByNumberRepo: $this->getCheckingAccountByNumberRepo,
        getPixKeyByCheckingAccountIdAndTypeRepo: $this->getPixKeyByCheckingAccountIdAndTypeRepo,
        createPixKeyByType: $this->createPixKeyByType,
        registerKeyRepo: $this->registerKeyRepo,
    );

    $inputBoundary = new RegisterKeyInput(
        PixKeyType::CPF->value,
        '06806573398',
        '06806573398'
    );

    $this->getCheckingAccountByNumberRepo
        ->shouldReceive('get')
        ->andReturn(CheckingAccount::reset());

    $this->getPixKeyByCheckingAccountIdAndTypeRepo
        ->shouldReceive('get')
        ->andReturn(PixKey::reset());

    $result = $this->useCase->handle($inputBoundary);

    expect($result->getMessage())->toBe('Pix Key with same type already registered for that account number given.');
});
