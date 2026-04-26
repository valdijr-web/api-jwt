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
        $this->middleware('auth:api')->except(['login', 'register']);
    }

    public function login(Request $request)
    {
        $credentials = $request->only(['email', 'password']);

        if (! $token = auth('api')->attempt($credentials)) {
            return response()->json(['error' => 'Não autorizado'], 401);
        }

         // Cria o cookie HttpOnly contendo o JWT
        $cookie = self::setCookie($token);

        return $this->respondWithToken($token, $cookie);
    }

    public function me()
    {
        return response()->json(auth('api')->user());
    }

    public function logout()
    {
        auth('api')->logout();
        $cookie = self::setCookie('');
        return response()->json(['message' => 'Logout efetuado com sucesso'])->withCookie($cookie);
    }

    // Esta é a função que o NextAuth chamará quando o token expirar
    public function refresh()
    {
        $newToken = auth('api')->refresh();
        $cookie = self::setCookie($newToken);
        return $this->respondWithToken($newToken, $cookie);
    }

    // Estrutura padrão de resposta do token
    protected function respondWithToken($token, $cookie = null)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60 // Tempo em segundos
        ])->withCookie($cookie);
    }

    protected function setCookie($token)
    {
        return cookie(
            'access_token',      // nome
            $token,              // valor
            config('jwt.ttl'),   // minutos (60)
            '/',                 // path
            null,                // domain (null = atual)
            false,                // secure (HTTPS)
            true,                // httpOnly
            false,               // raw
            'lax'             // sameSite
        );
    }
}
