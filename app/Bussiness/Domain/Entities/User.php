<?php

declare(strict_types=1);

namespace App\Bussiness\Domain\Entities;

use App\Bussiness\Domain\Enums\MaritalStatus;
use App\Bussiness\Domain\ValueObjects\BirthDate;
use App\Bussiness\Domain\ValueObjects\Cellphone;
use App\Bussiness\Domain\ValueObjects\Cpf;
use App\Bussiness\Domain\ValueObjects\Email;

final readonly class User
{
    private string $firstName;

    private string $lastName;

    private BirthDate $birthDate;

    private Cpf $cpf;

    private Email $email;

    private Cellphone $cellphone;

    private MaritalStatus $maritalStatus;

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

    public function getBirthDate(): BirthDate
    {
        return $this->birthDate;
    }

    public function setBirthDate(BirthDate $birthDate): static
    {
        $this->birthDate = $birthDate;

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

    public function setCellphone(Cellphone $cellphone): static
    {
        $this->cellphone = $cellphone;

        return $this;
    }

    public function getMaritalStatus(): MaritalStatus
    {
        return $this->maritalStatus;
    }

    public function setMaritalStatus(MaritalStatus $maritalStatus): static
    {
        $this->maritalStatus = $maritalStatus;

        return $this;
    }
}
