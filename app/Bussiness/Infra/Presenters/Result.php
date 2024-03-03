<?php

declare(strict_types=1);

namespace App\Bussiness\Infra\Presenters;

final readonly class Result
{
    public function __construct(
        private bool $success,
        private ?string $message = null,
        private mixed $data = null,
    ) {
    }

    public function toArray(): array
    {
        return [
            'success' => $this->success,
            'message' => $this->message,
            'data' => $this->data,
        ];
    }
}
