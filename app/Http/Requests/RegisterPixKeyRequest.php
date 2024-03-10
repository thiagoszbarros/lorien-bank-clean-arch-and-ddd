<?php

namespace App\Http\Requests;

use App\Bussiness\Domain\Enums\Messages;
use App\Bussiness\Domain\Enums\PixKeyType;
use Illuminate\Validation\Rule;

class RegisterPixKeyRequest extends Request
{
    public function rules(): array
    {
        return [
            'keyType' => [
                'required',
                Rule::in([
                    PixKeyType::CPF,
                    PixKeyType::EMAIL,
                    PixKeyType::CELLPHONE,
                    PixKeyType::RANDOM,
                ]),
            ],
            'key' => [
                'present',
                'nullable',
                'string',
            ],
            'accountNumber' => [
                'required',
                'string',
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'keyType.in' => Messages::INVALID_PIX_KEY_TYPE_GIVEN->value,
        ];
    }
}
