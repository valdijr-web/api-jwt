<?php

namespace App\Http\Requests\Address;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class ZipCodeRequest extends FormRequest
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
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'zip_code' => ['required', 'string', 'max:9', 'regex:/^\d{5}-?\d{3}$/']
        ];
    }

    public function messages(): array
    {
        return [
            'zip_code.required' => 'O campo CEP é obrigatório.',
            'zip_code.string'   => 'O CEP deve ser uma string.',
            'zip_code.regex'    => 'O CEP deve estar no formato 00000-000 ou 00000000.',
        ];
    }

    public function all($keys = null)
    {
        // Mescla os dados da requisição (body/query) com os parâmetros da URL
        $data = parent::all($keys);
        $data['zip_code'] = $this->route('zip_code');

        return $data;
    }
}
