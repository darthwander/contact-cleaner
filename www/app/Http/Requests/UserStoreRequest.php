<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserStoreRequest extends FormRequest
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
            'company_id' => ['required', 'exists:companies,id'],
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'password_confirmation' => ['required', 'string', 'same:password'],
            'active' => ['required', 'boolean'],
        ];
    }

    public function messages(): array
    {
        return [
            'company_id.required' => 'A empresa é obrigatória',
            'company_id.exists' => 'A empresa informada não existe',
            'name.required' => 'O nome da empresa é obrigatório',
            'name.string' => 'O nome da empresa deve ser uma string',
            'name.max' => 'O nome da empresa deve ter no máximo 255 caracteres',
            'email.required' => 'O email é obrigatório',
            'email.string' => 'O email deve ser uma string',
            'email.email' => 'O email deve ser um email',
            'email.max' => 'O email deve ter no máximo 255 caracteres',
            'email.unique' => 'O email informado já existe',
            'password.required' => 'A senha é obrigatória',
            'password.string' => 'A senha deve ser uma string',
            'password.min' => 'A senha deve ter no mínimo 8 caracteres',
            'password_confirmation.required' => 'A confirmação da senha é obrigatória',
            'password_confirmation.string' => 'A confirmação da senha deve ser uma string',
            'password_confirmation.same' => 'A confirmação da senha deve ser igual a senha',
            'active.required' => 'O status da conta é obrigatório',
            'active.boolean' => 'O status da conta deve ser true ou false',
        ];
    }
}
