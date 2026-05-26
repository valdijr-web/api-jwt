<?php

namespace App\Http\Controllers\Api\V1;

use App\Actions\Address\GetAddressByZipCodeAction as AddressGetAddressByZipCodeAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\Address\ZipCodeRequest;
use Illuminate\Http\JsonResponse;

class AddressController extends Controller
{
    public function getAddressByZipCode(ZipCodeRequest $request, AddressGetAddressByZipCodeAction $action): JsonResponse
    {

        $address = $action->execute($request->validated('zip_code'));

        if ($address === []) {
            return response()->json(['zip_code' => 'CEP não encontrado.'], 404);
        }

        return response()->json($address);
    }
}
