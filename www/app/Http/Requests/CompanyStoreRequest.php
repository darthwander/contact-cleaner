<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CompanyStoreRequest extends FormRequest
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
            'name' => 'required|string|max:255',
            'cnpj' => 'required|string|max:18|unique:companies,cnpj',
            'webhook_url' => 'max:255',
            'api_token' => 'max:255',
            'active' => 'required',
            'only_200' => 'required',
            'only_200_wp' => 'required',
            'code_487' => 'required',
            'delete_only_404' => 'required',
            'code_487' => 'required',
            'code_487_wp' => 'required',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'O nome da empresa é obrigatório',
            'name.string' => 'O nome da empresa deve ser uma string',
            'name.max' => 'O nome da empresa deve ter no máximo 255 caracteres',
            'cnpj.required' => 'O CNPJ da empresa é obrigatório',
            'cnpj.string' => 'O CNPJ da empresa deve ser uma string',
            'cnpj.max' => 'O CNPJ da empresa deve ter no máximo 18 caracteres',
            'cnpj.unique' => 'Ja existe uma empresa com este CNPJ',
            'webhook_url.string' => 'O Webhook URL deve ser uma string',
            'webhook_url.max' => 'O Webhook URL deve ter no máximo 255 caracteres',
            'api_token.string' => 'O Api Token deve ser uma string',
            'api_token.max' => 'O Api Token deve ter no máximo 255 caracteres',
        ];
    }
}
