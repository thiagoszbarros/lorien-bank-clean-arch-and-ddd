<?php

namespace App\Http\Controllers;

use App\Bussiness\Infra\Presenters\Result;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    public function success(
        Result $result,
    ): Response {
        return new Response(
            content: $result->toArray(),
            status: Response::HTTP_OK
        );
    }

    public function fail(
        Result $result,
    ): Response {
        return new Response(
            content: $result->toArray(),
            status: Response::HTTP_BAD_REQUEST,
        );
    }
}
