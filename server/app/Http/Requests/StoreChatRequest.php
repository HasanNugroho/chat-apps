<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;

class StoreChatRequest extends FormRequest
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

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'message' => ['required', 'string'],
            'actorDisplayName' => ['string', 'max:255'],
            'replyTo' => ['uuid'],
            'silent' => ['boolean'],
        ];
    }

    public function failedValidation(Validator $validator)
    {
        
        throw new HttpResponseException(response()->json([
            'metadata' => [
                'success' => false,
                'errorCode' => 400,
                'message' => 'Validation errors',
            ],
            'data' => $validator->errors()
        ]));
    }
}
