<?php

namespace App\Exceptions;

use App\Bussiness\Domain\Enums\Messages;
use App\Bussiness\Infra\Presenters\Result;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * The list of the inputs that are never flashed to the session on validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     */
    public function register(): void
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }

    public function render($request, Throwable $exception): Response
    {
        Log::info($exception);

        if (env('APP_ENV') === 'local' || env('APP_ENV') === 'testing') {
            return $this->error($exception->getMessage());
        }

        return $this->error(Messages::SOMETHING_WENT_WRONG->value);
    }

    private function error(string $message): Response
    {
        $result = Result::reset()
            ->setSuccess(success: false)
            ->setMessages(messages: $message)
            ->setData(data: null)
            ->toArray();

        return new Response(
            content: $result,
            status: Response::HTTP_INTERNAL_SERVER_ERROR,
        );
    }
}
