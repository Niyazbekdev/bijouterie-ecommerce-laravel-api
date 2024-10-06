<?php

namespace App\Http\Requests\v1;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProductRequest extends FormRequest
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
            'name' => 'nullable',
            'description' => 'nullable',
            'price' => 'nullable|integer|min:0',
            'quantity' => 'nullable|integer|min:0',
            'category_id' => 'nullable|integer',
            'brand_id' => 'nullable|integer',
            'colors' => 'nullable|array',
            'colors.*.id' => 'nullable|integer',
            'colors.*.qauntity' => 'nullable|string',
        ];
    }
}
