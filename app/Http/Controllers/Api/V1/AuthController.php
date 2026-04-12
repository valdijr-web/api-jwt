<?php

namespace App\Http\Controllers\Api\V1;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class AuthController extends Controller
{
    // Construtor para proteger as rotas, exceto login e registo
    public function __construct()
    {
        //$this->middleware('auth:api', ['except' => ['login', 'register']]);
        $this->middleware('auth:api')->except(['login', 'register']);
    }

    public function login(Request $request)
    {
        $credentials = $request->only(['email', 'password']);

        if (! $token = auth('api')->attempt($credentials)) {
            return response()->json(['error' => 'Não autorizado'], 401);
        }

        return $this->respondWithToken($token);
    }

    public function me()
    {
        return response()->json(auth('api')->user());
    }

    public function logout()
    {
        auth('api')->logout();
        return response()->json(['message' => 'Logout efetuado com sucesso']);
    }

    // Esta é a função que o NextAuth chamará quando o token expirar
    public function refresh()
    {
        return $this->respondWithToken(auth()->refresh());
    }

    // Estrutura padrão de resposta do token
    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60 // Tempo em segundos
        ]);
    }
}
