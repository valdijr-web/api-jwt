<?php
namespace App\Actions\Auth;

use Exception;

class LoginAction
{
    public function execute(array $credentials): string
    {
        if (! $token = auth('api')->attempt($credentials)) {
            // Lançar uma exceção permite que o Laravel ou o Controller
            // lidem com o erro de forma padronizada
            throw new Exception('Credenciais inválidas', 401);
        }

        return $token;
    }
}
