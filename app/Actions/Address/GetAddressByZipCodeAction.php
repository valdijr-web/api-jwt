<?php

namespace App\Actions\Address;

use App\Models\Patient;
use App\Services\TenantManager;
use App\Services\ViaCepClient;
use Illuminate\Support\Facades\DB;
use Exception;

class GetAddressByZipCodeAction
{
    public function __construct(protected ViaCepClient $client) {}

    public function execute(string $zip_code): array
    {
        try {
            $address = $this->client->getAddress($zip_code);
            if (isset($address['erro']) && $address['erro']) {
                return [];
            }
            return [
                'zip_code'     => $address['cep'],
                'street'      => $address['logradouro'],
                'neighborhood' => $address['bairro'],
                'city'         => $address['localidade'],
                'state'        => $address['uf'],
                'complement'   => $address['complemento']
            ];

        } catch (Exception $e) {
            throw new Exception("Erro inesperado a buscar endereço por cep");
        }
    }
}
