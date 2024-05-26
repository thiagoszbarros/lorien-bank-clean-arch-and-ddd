<?php

use App\Bussiness\Application\Services\CreatePixKeyByType;
use App\Bussiness\Application\UseCases\Dtos\RegisterKeyInput;
use App\Bussiness\Application\UseCases\RegisterKey;
use App\Bussiness\Domain\Enums\PixKeyType;
use App\Bussiness\Domain\Repositories\IGetCheckingAccountByNumber;
use App\Bussiness\Domain\Repositories\IGetPixKeyByCheckingAccountIdAndType;
use App\Bussiness\Domain\Repositories\IRegisterKey;

it('should return invalid pix key type error message', function (): void {
    $this->useCase = new RegisterKey(
        getCheckingAccountByNumberRepo: Mockery::mock(IGetCheckingAccountByNumber::class),
        getPixKeyByCheckingAccountIdAndTypeRepo: Mockery::mock(IGetPixKeyByCheckingAccountIdAndType::class),
        createPixKeyByType: Mockery::mock(CreatePixKeyByType::class),
        registerKeyRepo: Mockery::mock(IRegisterKey::class),
    );

    $inputBoundary = new RegisterKeyInput(
        PixKeyType::CNPJ->value,
        '068065733981234',
        '06806573398'
    );

    $result = $this->useCase->handle($inputBoundary);

    expect($result->getMessage())->toBe('Invalid pix key type given. Accepted types: 1 - CPF, 2 - EMAIL, 3 - CELLPHONE, 4 - RANDOM');
});
