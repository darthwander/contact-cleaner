<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserUpdateRequest extends FormRequest
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
        $id = $this->route()->parameter('id');

        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,' . $id],
            'active' => ['required', 'boolean'],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'O nome da empresa é obrigatório',
            'name.string' => 'O nome da empresa deve ser uma string',
            'name.max' => 'O nome da empresa deve ter no máximo 255 caracteres',
            'email.required' => 'O email é obrigatório',
            'email.string' => 'O email deve ser uma string',
            'email.email' => 'O email deve ser um email',
            'email.max' => 'O email deve ter no máximo 255 caracteres',
            'email.unique' => 'O email informado já existe',
        ];
    }
}
