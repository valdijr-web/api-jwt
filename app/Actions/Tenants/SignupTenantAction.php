<?php

namespace App\Actions\Tenants;

use App\Models\Tenant;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class SignupTenantAction
{
    public function execute(array $data): array
    {
        return DB::transaction(function () use ($data) {

            // 🔒 Validar e-mail global (SaaS geralmente não permite duplicado)
            $emailExists = User::where('email', $data['email'])->exists();

            if ($emailExists) {
                throw ValidationException::withMessages([
                    'email' => ['Já existe uma conta com o E-mail informado. Utilize outro E-mail ou faça login.'],
                ]);
            }

            // 🏢 Criar tenant
            $tenant = Tenant::create([
                'trade_name' => $data['trade_name'],
                'whatsapp_number' => $data['whatsapp_number'] ?? null,
            ]);

            // 👤 Criar usuário dono (owner/admin)
            $user = new User();
            $user->tenant_id = $tenant->id;
            $user->name = $data['name'];
            $user->email = $data['email'];
            $user->password = Hash::make($data['password']);
            $user->save();
            $token = auth('api')->login($user);
            return [
                'tenant' => $tenant,
                'user'   => $user,
                'token'  => $token,
            ];
        });
    }
}
