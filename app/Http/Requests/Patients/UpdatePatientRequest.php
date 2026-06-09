<?php

namespace App\Http\Requests\Patients;

use App\Services\TenantManager;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdatePatientRequest extends FormRequest
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
        $id = $this->route('patient')->id; // Obtém o ID do paciente da rota
        if ($id instanceof \App\Models\Patient) {
            $id = $id->id;
        }

        return [
            // Dados Pessoais Básicos
            'name' => ['required', 'string', 'max:255'],
            'birth_date' => ['nullable', 'date', 'before_or_equal:today'],
            'gender' => ['required', 'string', 'in:Masculino,Feminino,Outro'],
            // Documentos com validação de unicidade isolada por Tenant
            'cpf' => [
                'nullable',
                'string',
                'max:14', // Aceita com ou sem máscara (000.000.000-00)
                Rule::unique('patients', 'cpf')
                    ->ignore($id)
                    ->where('tenant_id', $tenantId)
                    ->whereNull('deleted_at'),
            ],
            'rg' => ['nullable', 'string', 'max:20'],

            // Contatos
            'email' => [
                'nullable',
                'email',
                'max:255',
                Rule::unique('patients', 'email')
                    ->ignore($id)
                    ->where('tenant_id', $tenantId)
                    ->whereNull('deleted_at'),
            ],
            'phone_number' => ['nullable', 'string', 'max:20'],
            'emergency_contact' => ['nullable', 'string', 'max:20'],

            // Dados de Endereço (validação aninhada)
            'address.zip_code' => ['nullable', 'string', 'max:9'],
            'address.street' => ['nullable', 'string'],
            'address.number' => ['nullable', 'string'],
            'address.complement' => ['nullable', 'string'],
            'address.neighborhood' => ['nullable', 'string'],
            'address.city' => ['nullable', 'string'],
            'address.state' => ['nullable', 'string', 'size:2'],
            'address.country' => ['nullable', 'string', 'max:100'],
        ];
    }
}
