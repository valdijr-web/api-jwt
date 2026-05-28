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

            // Dados de Endereço (validação aninhada)
            'address.zip_code' => ['required', 'string', 'max:9'],
            'address.street' => ['required', 'string'],
            'address.number' => ['required', 'string'],
            'address.complement' => ['nullable', 'string'],
            'address.neighborhood' => ['required', 'string'],
            'address.city' => ['required', 'string'],
            'address.state' => ['required', 'string', 'size:2'],
            'address.country' => ['required', 'string', 'max:100'],
        ];
    }
}
