<?php

namespace App\Http\Requests\v1;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductRequest extends FormRequest
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
            'name.kaa' => 'required',
            'name.ru' => 'required',
            'description.kaa' => 'nullable',
            'description.ru' => 'nullable',
            'price' => 'required',
            'quantity' => 'required',
            'category_id' => 'required',
            'brand_id' => 'nullable',
            'images' => 'nullable|array',
            'images.*' => 'file|image|mimes:jpeg,png,jpg,gif|max:5156',
            'colors' => 'nullable|array',
            'colors.*.id' => 'integer',
            'colors.*.quantity' => 'string',
        ];
    }
}
