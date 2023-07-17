<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateEventRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'event_title' => ['bail', 'required', 'string', 'max:255'],
            'event_start_date' => ['bail', 'required', 'date'],
            'event_end_date' => ['bail', 'required', 'date'],
            'event_location' => ['bail', 'required', 'string', 'max:255'],
            'event_private' => ['bail', 'required', 'boolean'],
            'event_description' => ['bail', 'required', 'string'],
            'event_image' => ['bail', 'required', 'image', 'mimes:jpeg,png,jpg', 'dimensions:min_width=200,min_height=200'],
            'items' => ['bail', 'required', 'array'],
        ];
    }

    public function messages(): array
    {
        return [
            'event_title.required' => 'O título do evento é obrigatório',
            'event_start_date.required' => 'A data de início do evento é obrigatória',
            'event_end_date.required' => 'A data de término do evento é obrigatória',
            'event_location.required' => 'A localização do evento é obrigatória',
            'event_private.required' => 'O privado do evento é obrigatório',
            'event_description.required' => 'A descrição do evento é obrigatária',
            
            'event_image.image' => 'A imagem do evento deve ser uma imagem',
            'event_image.mimes' => 'A extensão da imagem do evento deve ser jpeg, png ou jpg',
            'event_image.dimensions' => 'A imagem do evento deve ter no mínimo 200px de largura e 200px de altura'
        ];
    }
}
