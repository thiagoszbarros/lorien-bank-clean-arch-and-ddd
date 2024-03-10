<?php

namespace App\Http\Controllers;

use App\Bussiness\Application\UseCases\Dtos\RegisterKeyInput;
use App\Bussiness\Application\UseCases\RegisterKey;
use App\Bussiness\Infra\Presenters\Result;
use App\Http\Requests\RegisterPixKeyRequest;
use Illuminate\Http\Response;

class RegisterKeyController extends Controller
{
    public function __construct(private RegisterKey $useCase)
    {
    }

    public function __invoke(RegisterPixKeyRequest $request): Response
    {
        $useCaseReturn = $this->useCase->handle(
            new RegisterKeyInput(
                $request->keyType,
                $request->key,
                $request->accountNumber,
            )
        );

        $result = Result::reset()
            ->setSuccess(success: $useCaseReturn->getSuccess())
            ->setMessages(messages: $useCaseReturn->getMessage())
            ->setData(null);

        return $useCaseReturn->getSuccess() === true ?
            $this->success($result) :
            $this->fail($result);
    }
}
