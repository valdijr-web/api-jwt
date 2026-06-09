<?php
namespace App\Actions\Patients;
use App\Models\Patient;
use Illuminate\Support\Facades\DB;
use Exception;

class DeletePatientsAction
{
    public function execute(array $patientIds): int
    {
        try {
            return DB::transaction(function () use ($patientIds) {
                $users = Patient::whereIn('id', $patientIds)->get();

                $count = 0;
                foreach ($users as $user) {
                    $user->delete();
                    $count++;
                }

                return $count;
            });
        } catch (Exception $e) {
            throw new Exception("Erro interno ao tentar excluir pacientes.");
        }
    }
}
