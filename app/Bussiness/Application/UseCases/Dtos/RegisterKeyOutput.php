<?php

declare(strict_types=1);

namespace App\Bussiness\Application\UseCases\Dtos;

use App\Bussiness\Domain\Enums\Messages;

class RegisterKeyOutput
{
    public function __construct(
        private bool $success,
        private Messages $message,
    ) {
    }

    public function getSuccess(): bool
    {
        return $this->success;
    }

    public function getMessage(): string
    {
        return $this->message->value;
    }
}
