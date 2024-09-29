<?php

namespace App\Http\Requests\v1;

use Illuminate\Foundation\Http\FormRequest;

class storeChildCategoryRequest extends FormRequest
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
            'children.*.name.kaa' => 'required',
            'children.*.name.ru' => 'required',
            'children.*icon' => 'nullable|file|image|mimes:jpeg,png,jpg,webp|max:5154',
        ];
    }
}