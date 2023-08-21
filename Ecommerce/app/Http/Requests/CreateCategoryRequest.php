<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateCategoryRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'category_name' => ['required', 'string','unique:categories,name', 'max:255'],
            'category_icon' => ['required', 'not_in:empty', 'max:255'],
            'category_status' => ['required', 'boolean']
        ];
    }

    public function messages(): array
    {
        return [
            'category_name.required' => 'Category name is required',
            'category_name.string' => 'Category name must be a string',
            'category_name.max' => 'Category name must be less than 255 characters',
            'category_icon.required' => 'Category icon is required',
            'category_icon.max' => 'Category icon must be less than 255 characters',
            'category_status.required' => 'Category status is required'
        ];
    }
}
