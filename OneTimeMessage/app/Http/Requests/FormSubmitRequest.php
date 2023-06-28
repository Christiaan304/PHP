<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FormSubmitRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'input_email_from' => ['bail', 'required', 'email'],
            'input_email_to' => ['bail', 'required', 'email'],
            'email_message' => ['bail', 'required', 'string', 'max:255']
        ];
    }

    public function messages()
    {
        return [
            'input_email_from.required' => "Email 'De' obrigatório",
            'input_email_from.email' => "Email 'De' inválido",
            'input_email_to.required' => "Email 'Para' obrigatório",
            'input_email_to.email' => "Email 'Para' inválido",
            'email_message.required' => 'Menssagem obrigatória',
            'email_message.max' => 'A menssagem deve conter no máximo 255 caracteres'
        ];
    }
}
