<?php

namespace App\Http\Requests\Patients;

use App\Services\TenantManager;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StorePatientRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return $this->user() !== null;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        // Captura o tenant atual para isolar as validações exclusivas (ex: CPF único por clínica)
        $tenantId = app(TenantManager::class)->getTenantId();

        return [
            // Dados Pessoais Básicos
            'name' => ['required', 'string', 'max:255'],
            'birth_date' => ['nullable', 'date', 'before_or_equal:today'],
            'gender' => ['nullable', 'string', 'in:Masculino,Feminino,Outro'],

            // Documentos com validação de unicidade isolada por Tenant
            'cpf' => [
                'nullable',
                'string',
                'max:14', // Aceita com ou sem máscara (000.000.000-00)
                Rule::unique('patients', 'cpf')->where(fn ($query) => $query->where('tenant_id', $tenantId))
            ],
            'rg' => ['nullable', 'string', 'max:20'],

            // Contatos
            'email' => [
                'nullable',
                'email',
                'max:255',
                Rule::unique('patients', 'email')->where(fn ($query) => $query->where('tenant_id', $tenantId))
            ],
            'phone_number' => ['nullable', 'string', 'max:20'],
            'emergency_contact' => ['nullable', 'string', 'max:20'],

            // Endereço
            'zip_code' => ['nullable', 'string', 'max:9'], // Formato XXXXX-XXX
            'street' => ['nullable', 'string', 'max:255'],
            'address_number' => ['nullable', 'string', 'max:20'],
            'complement' => ['nullable', 'string', 'max:255'],
            'neighborhood' => ['nullable', 'string', 'max:100'],
            'city' => ['nullable', 'string', 'max:100'],
            'state' => ['nullable', 'string', 'size:2'], // Sigla do estado (PE, SP, PB...)
            'country' => ['nullable', 'string', 'max:100'],
        ];
    }
}
