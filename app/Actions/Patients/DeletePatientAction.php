<?php
namespace App\Actions\Patients;

use App\Models\Patient;
use Exception;
use Illuminate\Support\Facades\DB;

class DeletePatientAction
{
    public function execute(Patient $patient): ?bool
    {
        try {
             return DB::transaction(function () use ($patient){
                return $patient->delete();
            });
        } catch (Exception $e) {
            throw new Exception("Erro interno ao tentar excluir paciente.");
        }

    }
}
