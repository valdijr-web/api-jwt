<?php

namespace App\Http\Requests\Users;

use App\Services\TenantManager;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CreateUserRequest extends FormRequest
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
        $tenantId = app(TenantManager::class)->getTenantId();
        return [
            'name' => ['required', 'string', 'max:255', 'min:2'],
            'password' => ['required', 'string', 'min:8'],
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                // Garante que o e-mail seja único apenas dentro do mesmo tenant
                Rule::unique('users', 'email')->where(function ($query) use ($tenantId) {
                    return $query->where('tenant_id', $tenantId);
                }),
            ],
        ];
    }
}
