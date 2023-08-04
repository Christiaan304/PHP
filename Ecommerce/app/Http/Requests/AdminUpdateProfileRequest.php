<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AdminUpdateProfileRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => ['bail', 'required', 'max:255'],
            'email' => ['bail', 'required', 'email', 'unique:users,email,' . auth()->user()->id],
            'image' => ['nullable', 'image', 'mimes:jpeg,png,jpg', 'max:2048'],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Name is required',
            'name.max' => 'Name cannot be more than 255 characters',
            'email.unique' => 'Email already exists',
            'email.required' => 'Email is required',
            'image.image' => 'Image must be an image',
            'image.mimes' => 'Image must be a jpeg, png, jpg',
            'image.max' => 'Image cannot be more than 2MB'
        ];
    }
}
