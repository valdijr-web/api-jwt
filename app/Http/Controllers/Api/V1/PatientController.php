<?php

namespace App\Http\Controllers\Api\V1;

use App\Actions\Patients\CreatePatientAction;
use App\Actions\Patients\DeletePatientAction;
use App\Actions\Patients\DeletePatientsAction;
use App\Actions\Patients\ListPatientsAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\Patients\BulkDeletePatientRequest;
use App\Http\Requests\Patients\IndexPatientRequest;
use App\Http\Requests\Patients\StorePatientRequest;
use App\Models\Patient;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class PatientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(IndexPatientRequest $request, ListPatientsAction $action): JsonResponse
    {
        $patients = $action->execute($request->validated());

        return response()->json($patients);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePatientRequest $request, CreatePatientAction $action)
    {
        // 1. Executa a Action passando APENAS os dados que passaram na validação do Request
        $patient = $action->execute($request->validated());

        // 2. Retorna a resposta JSON com o status 201 (Created)
        // Se você usar API Resources (altamente recomendado), mude para: return (new PatientResource($patient))->response()->setStatusCode(201);
        return response()->json([
            'message' => 'Paciente cadastrado com sucesso!',
            'data' => $patient
        ], Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     */
    public function show(Patient $patient)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Patient $patient)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Patient $patient)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Patient $patient, DeletePatientAction $deletePatientAction): JsonResponse
    {
        $deletePatientAction->execute($patient);

        return response()->json([
            'message' => 'Paciente excluído com sucesso!'
        ], 200);
    }

    public function bulkDelete(BulkDeletePatientRequest $request, DeletePatientsAction $deletePatientsAction): JsonResponse
    {
        $deletedCount = $deletePatientsAction->execute($request->validated()['ids']);
        $message = trans_choice(
            '{1} :count paciente excluído com sucesso!|[2,*] :count pacientes excluídos com sucesso!',
            $deletedCount,
            ['count' => $deletedCount]
        );
        return response()->json([
            'message' => $message
        ], 200);
    }
}
