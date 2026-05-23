<?php

namespace Database\Seeders;

use App\Models\Patient;
use App\Models\Tenant;
use App\Services\TenantManager;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PatientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. Criamos um Tenant específico para este lote de pacientes
        // $tenant = Tenant::factory()->create([
        //     'trade_name' => 'Clínica Kariri Saúde'
        // ]);
        $tenant = Tenant::find(1);
        app(TenantManager::class)->setTenant($tenant);
        // 2. Criamos os pacientes vinculados a este Tenant de forma sequencial
        Patient::factory()
            ->count(10)->create([
                'tenant_id' => $tenant->id,

            ]);
    }
}
