<?php
namespace App\Actions\Patients;

use App\Models\Patient;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Arr;

class CreatePatientAction
{

    public function execute(array $data): Patient
    {

         return DB::transaction(function () use ($data) {

            //Separar endereço
            $addressData = $data['address'];

            //Dados do paciente
            $patientData = Arr::except($data, ['address']);

            //Criar paciente
            $patient = Patient::create($patientData);

            //Criar endereço relacionado
            $patient->address()->create($addressData);

            //Retornar com relacionamento
            return $patient->load('address');
        });
    }
}
