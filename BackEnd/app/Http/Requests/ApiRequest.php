<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use App\Enums\ResponseEnum;

class ApiRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    protected function failedValidation(\Illuminate\Contracts\Validation\Validator $validator)
    {
        $errors = $validator->errors()->toArray();
        $formattedErrors = [];
        foreach ($errors as $field => $errorMessages) {
            $formattedErrors['message'][$field] = implode(' | ', $errorMessages);
        }
        $response = response()->json([
            'response_status' => ResponseEnum::RES_STATUS_ERROR_VALIDATE,
            'response_body' => $formattedErrors,
        ], ResponseEnum::HTTP_STATUS_ERROR);

        throw new HttpResponseException($response);
}
}
