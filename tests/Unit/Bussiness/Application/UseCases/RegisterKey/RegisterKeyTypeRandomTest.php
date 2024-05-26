<?php

use App\Bussiness\Application\Services\CreatePixKeyByType;
use App\Bussiness\Application\UseCases\Dtos\RegisterKeyInput;
use App\Bussiness\Application\UseCases\RegisterKey;
use App\Bussiness\Domain\Entities\CheckingAccount;
use App\Bussiness\Domain\Enums\PixKeyType;
use App\Bussiness\Domain\Repositories\IGetCheckingAccountByNumber;
use App\Bussiness\Domain\Repositories\IGetPixKeyByCheckingAccountIdAndType;
use App\Bussiness\Domain\Repositories\IRegisterKey;
use App\Bussiness\Domain\ValueObjects\RandomKey;
use Ramsey\Uuid\Uuid;

it('should registrate pix key type random successfully', function (): void {
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

    $this->createPixKeyByType
        ->shouldReceive('handle')
        ->andReturn(new RandomKey(Uuid::uuid4()->toString()));

    $this->registerKeyRepo
        ->shouldReceive('register')
        ->andReturn(true);

    $result = $this->useCase->handle($inputBoundary);

    expect($result->getMessage())->toBe('Pix Key successfully registered.');
});
