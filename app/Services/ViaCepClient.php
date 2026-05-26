<?php
namespace App\Services;
use Illuminate\Support\Facades\Http;

class ViaCepClient {
    public function getAddress(string $zip_code): array {
        return Http::get("https://viacep.com.br/ws/{$zip_code}/json/")->json();
    }
}
