<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Validation\ValidationException;

class Request extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    /**
     * @throws ValidationException When the form is invalid.
     */
    protected function failedValidation(Validator $validator): void
    {
        throw new ValidationException(validator: $validator);
    }
}
