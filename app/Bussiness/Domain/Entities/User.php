<?php

declare(strict_types=1);

namespace App\Bussiness\Domain\Entities;

use App\Bussiness\Domain\ValueObjects\Cellphone;
use App\Bussiness\Domain\ValueObjects\Cpf;
use App\Bussiness\Domain\ValueObjects\Email;

final readonly class User
{
    private string $firstName;

    private string $lastName;

    private Cpf $cpf;

    private Email $email;

    private Cellphone $cellphone;

    private function __construct()
    {
    }

    public static function reset(): static
    {
        return new User();
    }

    public function getFirstName(): string
    {
        return $this->firstName;
    }

    public function setFirstName(string $firstName): static
    {
        $this->firstName = $firstName;

        return $this;
    }

    public function getLastName(): string
    {
        return $this->lastName;
    }

    public function setLastName(string $lastName): static
    {
        $this->lastName = $lastName;

        return $this;
    }

    public function getCpf(): Cpf
    {
        return $this->cpf;
    }

    public function setCpf(Cpf $cpf): static
    {
        $this->cpf = $cpf;

        return $this;
    }

    public function getEmail(): Email
    {
        return $this->email;
    }

    public function setEmail(Email $email): static
    {
        $this->email = $email;

        return $this;
    }

    public function getCellphone(): Cellphone
    {
        return $this->cellphone;
    }

    public function setCellphone($cellphone): static
    {
        $this->cellphone = $cellphone;

        return $this;
    }
}
