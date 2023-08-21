<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateSubcategoryRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'parent_category' => ['required', 'exists:categories,id'],
            'subcategory_name' => ['required', 'string', 'max:255'],
            'subcategory_status' => ['required', 'boolean'],
        ];
    }

    public function messages(): array
    {
        return [
            'parent_category.exists' => 'The parent category does not exist',
            'parent_category.required' => 'The parent category is required',
            'subcategory_name.required' => 'The subcategory name is required',
            'subcategory_name.string' => 'The subcategory name must be a string',
            'subcategory_name.max' => 'The subcategory name must be less than 255 characters',
            'subcategory_status.required' => 'The subcategory status is required',
        ];
    }
}
