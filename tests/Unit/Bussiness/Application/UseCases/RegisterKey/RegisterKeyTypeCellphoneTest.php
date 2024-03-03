<?php

use App\Bussiness\Application\Services\CreatePixKeyByType;
use App\Bussiness\Application\UseCases\Dtos\RegisterKeyInput;
use App\Bussiness\Application\UseCases\RegisterKey;
use App\Bussiness\Domain\Entities\CheckingAccount;
use App\Bussiness\Domain\Enums\PixKeyType;
use App\Bussiness\Domain\Repositories\IGetCheckingAccountByNumber;
use App\Bussiness\Domain\Repositories\IGetPixKeyByCheckingAccountIdAndType;
use App\Bussiness\Domain\Repositories\IRegisterKey;
use App\Bussiness\Domain\ValueObjects\Cellphone;

it('should registrate pix key type cellphone successfully', function (): void {
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
        PixKeyType::CELLPHONE->value,
        '99999999999',
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
        ->andReturn(new Cellphone('99999999999'));

    $this->registerKeyRepo
        ->shouldReceive('register')
        ->andReturn(true);

    $result = $this->useCase
        ->handle($inputBoundary);

    expect($result->getMessage())->toBe('Pix Key successfully registered.');
});
