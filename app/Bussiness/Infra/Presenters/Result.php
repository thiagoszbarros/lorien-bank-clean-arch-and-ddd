<?php

declare(strict_types=1);

namespace App\Bussiness\Infra\Presenters;

final readonly class Result
{
    private bool $success;

    private array $messages;

    private mixed $data;

    private function __construct(
    ) {
    }

    public static function reset(): static
    {
        return new Result();
    }

    public function getSuccess(): bool
    {
        return $this->success;
    }

    public function setSuccess(bool $success): static
    {
        $this->success = $success;

        return $this;
    }

    /**
     * @return array<string>
     */
    public function getMessages(): array
    {
        return $this->messages;
    }

    public function setMessages(array|string $messages): static
    {
        if (is_string($messages)) {
            $this->messages = [$messages];

            return $this;
        }

        $this->messages = [...$messages];

        return $this;
    }

    public function getData(): mixed
    {
        return $this->data;
    }

    public function setData(mixed $data): static
    {
        $this->data = $data;

        return $this;
    }

    public function toArray(): array
    {
        return [
            'success' => $this->success,
            'messages' => $this->messages,
            'data' => $this->data,
        ];
    }
}
