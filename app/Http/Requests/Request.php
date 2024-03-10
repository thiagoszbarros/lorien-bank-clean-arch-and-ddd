<?php

namespace App\Http\Requests;

use App\Bussiness\Infra\Presenters\Result;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class Request extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    protected function failedValidation(Validator $validator): Response
    {
        $result = Result::reset()
            ->setSuccess(success: false)
            ->setMessages(messages: $validator->getMessageBag()->all())
            ->setData(data: null)
            ->toArray();

        return new Response(
            content: $result,
            status: Response::HTTP_BAD_REQUEST
        );
    }
}
