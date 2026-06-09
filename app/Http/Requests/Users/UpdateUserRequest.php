<?php

namespace App\Http\Requests\Users;

use App\Services\TenantManager;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rule;

class UpdateUserRequest extends FormRequest
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
        $id = $this->route('user')->id; // Obtém o ID do usuário da rota
        // Se você passou um objeto (Route Model Binding), pegue o ID dele:
        if ($id instanceof \App\Models\User) {
            $id = $id->id;
        }
        return [
            'name' => ['required', 'string', 'max:255', 'min:2'],
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique('users')
                    ->ignore($id)
                    ->where('tenant_id', $tenantId)
                    ->whereNull('deleted_at'),
            ],
            'password' => ['nullable', 'string', 'min:8'],
        ];
    }
}
