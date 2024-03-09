<?php

namespace App\Http\Controllers;

use App\Bussiness\Application\UseCases\Dtos\RegisterKeyInput;
use App\Bussiness\Application\UseCases\RegisterKey;
use App\Bussiness\Infra\Presenters\Result;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class RegisterKeyController extends Controller
{
    public function __construct(private RegisterKey $useCase)
    {
    }

    public function __invoke(Request $request): Response
    {
        $useCaseReturn = $this->useCase->handle(
            new RegisterKeyInput(
                $request->keyType,
                $request->key,
                $request->accountNumber,
            )
        );

        if (!$useCaseReturn->getSuccess()) {

            return $this->fail(
                new Result(
                    success: $useCaseReturn->getSuccess(),
                    message: $useCaseReturn->getMessage(),
                )
            );

        }

        return $this->success(
            new Result(
                success: $useCaseReturn->getSuccess(),
                message: $useCaseReturn->getMessage(),
            )
        );
    }
}
