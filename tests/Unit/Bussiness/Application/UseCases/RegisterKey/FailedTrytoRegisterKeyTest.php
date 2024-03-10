<?php

use App\Bussiness\Application\Services\CreatePixKeyByType;
use App\Bussiness\Application\UseCases\Dtos\RegisterKeyInput;
use App\Bussiness\Application\UseCases\RegisterKey;
use App\Bussiness\Domain\Entities\CheckingAccount\CheckingAccount;
use App\Bussiness\Domain\Enums\PixKeyType;
use App\Bussiness\Domain\Repositories\IGetCheckingAccountByNumber;
use App\Bussiness\Domain\Repositories\IGetPixKeyByCheckingAccountIdAndType;
use App\Bussiness\Domain\Repositories\IRegisterKey;
use App\Bussiness\Domain\ValueObjects\Cpf;

it('should return failed to register key error message', function (): void {
    $this->getCheckingAccountByNumberRepo = Mockery::mock(IGetCheckingAccountByNumber::class);

    $this->getPixKeyByCheckingAccountIdAndTypeRepo = Mockery::mock(IGetPixKeyByCheckingAccountIdAndType::class);

    $this->registerKeyRepo = Mockery::mock(IRegisterKey::class);

    $this->createPixKeyByType = Mockery::mock(CreatePixKeyByType::class);

    $this->useCase = new RegisterKey(
        getCheckingAccountByNumberRepo: $this->getCheckingAccountByNumberRepo,
        getPixKeyByCheckingAccountIdAndTypeRepo: $this->getPixKeyByCheckingAccountIdAndTypeRepo,
        createPixKeyByType: $this->createPixKeyByType,
        registerKeyRepo: $this->registerKeyRepo,
    );

    $input = new RegisterKeyInput(
        PixKeyType::CPF->value,
        '06806573398',
        '06806573398'
    );

    $this->getCheckingAccountByNumberRepo
        ->shouldReceive('get')
        ->andReturn(CheckingAccount::reset());

    $this->getPixKeyByCheckingAccountIdAndTypeRepo
        ->shouldReceive('get')
        ->andReturn(null);

    $this->createPixKeyByType
        ->shouldReceive('handle')
        ->andReturn(new Cpf('06806573398'));

    $this->registerKeyRepo
        ->shouldReceive('register')
        ->andThrow(new \Exception());

    $this->useCase->handle($input);
})->expectException(Exception::class);
