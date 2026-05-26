<?php
namespace App\Actions\Patients;

use App\Models\Patient;
use App\Services\TenantManager;
use Illuminate\Support\Facades\DB;
use Exception;

class CreatePatientAction
{

    public function execute(array $data): Patient
    {
        return DB::transaction(function () use ($data) {
            return Patient::create($data);
        });
    }
}
