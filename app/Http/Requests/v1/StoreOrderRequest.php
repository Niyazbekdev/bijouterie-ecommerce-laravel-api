<?php

namespace App\Http\Requests\v1;

use Illuminate\Foundation\Http\FormRequest;

class StoreOrderRequest extends FormRequest
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
            'products.*' => 'array',
            'products.*.id' => 'integer|exists:products,id',
            'products.*.quantity' => 'integer|between:1,100',
            'products.*.color_id' => 'integer|exists:colors,id',
        ];
    }
}
