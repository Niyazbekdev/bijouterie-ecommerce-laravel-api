<?php

namespace App\Http\Requests\v1;

use Illuminate\Foundation\Http\FormRequest;

class StoreLoginRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'phone' => [
                'required_without:email',
                'string',
                'regex:/^998([0-9][012345789]|[0-9][125679]|7[01234569])[0-9]{7}$/'
            ],
            'email' => ['required_without:phone'],
            'password' => ['required', 'min:6'],
        ];
    }
}