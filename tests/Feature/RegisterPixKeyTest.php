<?php

declare(strict_types=1);

use App\Bussiness\Domain\Enums\PixKeyType;
use App\Models\User;

it('should create a pix key type cpf successfully', function () {
    $user = User::first();

    $response = $this->post(
        'api/register-pix-key',
        [
            'keyType' => PixKeyType::CPF->value,
            'key' => $user->checkingAccount->number,
            'accountNumber' => $user->checkingAccount->number,
        ]
    );

    $response->assertOk();
    expect($response->original['success'])->toBeTrue();
    expect($response->original['message'])->toBe('Pix Key successfully registered.');
    expect($response->original['data'])->toBeNull();
});

it('should create a pix key type email successfully', function () {
    $user = User::first();

    $response = $this->post(
        'api/register-pix-key',
        [
            'keyType' => PixKeyType::EMAIL->value,
            'key' => 'test@example.com',
            'accountNumber' => $user->checkingAccount->number,
        ]
    );

    $response->assertOk();
    expect($response->original['success'])->toBeTrue();
    expect($response->original['message'])->toBe('Pix Key successfully registered.');
    expect($response->original['data'])->toBeNull();
});

it('should create a pix key type cellphone successfully', function () {
    $user = User::first();

    $response = $this->post(
        'api/register-pix-key',
        [
            'keyType' => PixKeyType::CELLPHONE->value,
            'key' => '99999999999',
            'accountNumber' => $user->checkingAccount->number,
        ]
    );

    $response->assertOk();
    expect($response->original['success'])->toBeTrue();
    expect($response->original['message'])->toBe('Pix Key successfully registered.');
    expect($response->original['data'])->toBeNull();
});

it('should create a pix key type random successfully', function () {
    $user = User::first();

    $response = $this->post(
        'api/register-pix-key',
        [
            'keyType' => PixKeyType::RANDOM->value,
            'key' => null,
            'accountNumber' => $user->checkingAccount->number,
        ]
    );

    $response->assertOk();
    expect($response->original['success'])->toBeTrue();
    expect($response->original['message'])->toBe('Pix Key successfully registered.');
    expect($response->original['data'])->toBeNull();
});

it('should return invalid pix key type given message', function () {
    $user = User::first();

    $response = $this->post(
        'api/register-pix-key',
        [
            'keyType' => PixKeyType::CNPJ->value,
            'key' => $user->checkingAccount->number,
            'accountNumber' => $user->checkingAccount->number,
        ]
    );

    $response->assertBadRequest();
    expect($response->original['success'])->toBeFalse();
    expect($response->original['message'])->toBe('Invalid pix key type given. Accepted types: 1 - CPF, 2 - EMAIL, 3 - CELLPHONE, 4 - RANDOM');
    expect($response->original['data'])->toBeNull();
});

it('should return pix key type already registered message', function () {
    $user = User::first();

    $this->post(
        'api/register-pix-key',
        [
            'keyType' => PixKeyType::CPF->value,
            'key' => $user->checkingAccount->number,
            'accountNumber' => $user->checkingAccount->number,
        ]
    );

    $response = $this->post(
        'api/register-pix-key',
        [
            'keyType' => PixKeyType::CPF->value,
            'key' => $user->checkingAccount->number,
            'accountNumber' => $user->checkingAccount->number,
        ]
    );

    $response->assertBadRequest();
    expect($response->original['success'])->toBeFalse();
    expect($response->original['message'])->toBe('Pix Key with same type already registered for that account number given.');
    expect($response->original['data'])->toBeNull();
});

it('should return checking account not found message', function () {
    $response = $this->post(
        'api/register-pix-key',
        [
            'keyType' => PixKeyType::CPF->value,
            'key' => '12345678909',
            'accountNumber' => '12345678909',
        ]
    );

    $response->assertBadRequest();
    expect($response->original['success'])->toBeFalse();
    expect($response->original['message'])->toBe('Checking account not found.');
    expect($response->original['data'])->toBeNull();
});
