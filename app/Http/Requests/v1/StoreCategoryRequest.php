<?php

namespace App\Http\Requests\v1;

use Illuminate\Foundation\Http\FormRequest;

class StoreCategoryRequest extends FormRequest
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
            'icon' => 'nullable|file|image|mimes:jpeg,png,jpg,webp|max:5154',
            'children' => 'nullable|array',
            'children.*.name.kaa' => 'nullable|string',
            'children.*.name.ru' => 'nullable|string',
            'children.*.icon' => 'nullable|file|image|mimes:jpeg,png,jpg,webp|max:5154',
        ];
    }

    public function prepareForValidation(): void
    {
        $object = $this->name;
        $object['kaa'] = strtolower($object['kaa']);
        $object['ru'] = strtolower($object['ru']);

        $this->merge([
            'name' => $object,
        ]);
    }
}
