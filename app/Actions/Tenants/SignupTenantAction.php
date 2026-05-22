<?php

namespace App\Actions\Tenants;

use App\Models\Tenant;
use App\Models\Unit;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class SignupTenantAction
{
    public function execute(array $data): array
    {
        return DB::transaction(function () use ($data) {

            // 🏢 Criar tenant
            $tenant = Tenant::create([
                'trade_name' => $data['trade_name'],
                'whatsapp_number' => $data['whatsapp_number'] ?? null,
            ]);

            // Cria a Unidade Padrão do Tenant
            $unit = Unit::create([
                'tenant_id' => $tenant->id,
                'name' => 'Unidade Principal',
            ]);

            // 👤 Criar usuário dono (owner/admin)
            $user = new User();
            $user->tenant_id = $tenant->id;
            $user->unit_id = $unit->id; // Associa o usuário à unidade criada
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
