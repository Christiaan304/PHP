<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateSliderRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'type' => ['bail', 'required', 'string', 'max:255'],
            'title' => ['bail', 'required', 'string', 'max:255'],
            'starting_price' => ['bail', 'required', 'numeric', 'min:0', 'max:999999999999'],
            'button_url' => ['bail', 'required', 'url'],
            'image' => ['bail', 'nullable', 'image', 'mimes:jpeg,png,jpg', 'max:2048'],
            'slider_number' => ['bail', 'required', 'numeric', 'min:1', 'max:255'],
            'slider_status' => ['bail', 'required', 'boolean']
        ];
    }

    public function messages(): array
    {
        return [
            'type.required' => 'Type is required',
            'type.string' => 'Type must be a string',
            'type.max' => 'Type must be less than 255 characters',
            'title.required' => 'Title is required',
            'title.string' => 'Title must be a string',
            'title.max' => 'Title must be less than 255 characters',
            'starting_price.required' => 'Starting price is required',
            'starting_price.numeric' => 'Starting price must be a number',
            'starting_price.min' => 'Starting price must be greater than 0',
            'button_url.required' => 'Button url is required',
            'button_url.url' => 'Button url must be a valid url',
            'image.image' => 'Image must be an image',
            'image.mimes' => 'Image must be a jpeg, png or jpg',
            'image.max' => 'Image must be less than 2MB',
            'slider_number.required' => 'Slider number is required',
            'slider_number.numeric' => 'Slider number must be a number',
            'slider_number.min' => 'Slider number must be greater than 0',
            'slider_number.max' => 'Slider number must be less than 255',
            'slider_status.required' => 'Slider status is required',
            'slider_status.boolean' => 'Slider status must be a boolean'
        ];
    }
}
