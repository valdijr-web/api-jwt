<?php

namespace App\Http\Requests\Patients;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class IndexPatientRequest extends FormRequest
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
        return [
            'global_filter'  => ['nullable', 'string', 'max:100'],
            'created_from'   => ['nullable', 'date'],
            'created_to'     => ['nullable', 'date', 'after_or_equal:created_from'],

            // Validação estrita de ordenação para evitar SQL Injection via ORDER BY
            'sort_by'        => ['nullable', 'string', Rule::in(['friendly_id','name', 'cpf', 'phone_number', 'created_at'])],
            'sort_direction' => ['nullable', 'string', Rule::in(['asc', 'desc', 'ASC', 'DESC'])],

            // Validação da paginação
            'per_page'       => ['nullable', 'integer', 'min:1', 'max:100'],
            'page'           => ['nullable', 'integer', 'min:1'],
        ];
    }
}
