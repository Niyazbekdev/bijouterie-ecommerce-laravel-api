<?php

namespace App\Http\Requests\v1;

use Illuminate\Foundation\Http\FormRequest;

class FilterProductRequest extends FormRequest
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
            'search' => ['nullable', 'string'],
            'per_page' => ['nullable', 'integer', 'min:1', 'max:100'],
            'category' => ['nullable', 'integer'],
            'price' => ['nullable', 'in:asc,desc'],
            'created_at' => ['nullable', 'in:desc'],
            'sold' => ['nullable', 'in:asc'],
            'rating' => ['nullable', 'in:asc'],
            'from_price' => ['nullable', 'integer', 'min:1'],
            'to_price' => ['integer', 'nullable', 'after:from_price', 'min:1'],
            'colors' => ['nullable', 'array'],
            'colors.*' => ['required_unless:colors,null', 'integer'],
            'brands' => ['nullable', 'array'],
            'brands.*' => ['required_unless:brand,null', 'integer'],
        ];
    }
}
