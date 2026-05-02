<?php

namespace App\Http\Controllers\Api\V1;

use App\Actions\Auth\LoginAction;
use App\Actions\Auth\LogoutAction;
use App\Actions\Auth\RefreshAction;
use App\Actions\Auth\SetTokenCookieAction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\JsonResponse;
use \Symfony\Component\HttpFoundation\Cookie;

class AuthController extends Controller
{
    // Construtor para proteger as rotas, exceto login e registo
    public function __construct(
        private LoginAction $loginAction,
        private LogoutAction $logoutAction,
        private RefreshAction $refreshAction,
        private SetTokenCookieAction $setTokenCookieAction
    ) {
        $this->middleware('auth:api')->except(['login', 'register', 'refresh' ]);
    }

    public function login(Request $request): JsonResponse
    {
        $credentials = $request->only(['email', 'password']);

        try {
            $token = $this->loginAction->execute($credentials);

            // Cria o cookie HttpOnly contendo o JWT
            $cookie = $this->setTokenCookieAction->execute($token);
            return $this->respondWithToken($token, $cookie);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], $e->getCode() ?: 401);
        }
    }

    public function me(): JsonResponse
    {
        try {
            return response()->json(auth('api')->user());
        } catch (Exception $e) {
            return response()->json(['error' => 'Erro ao obter usuário autenticado'], 500);
        }
    }

    public function logout(): JsonResponse
    {
        try {
            $this->logoutAction->execute();
            $cookie = $this->setTokenCookieAction->execute('');
            return response()->json(['message' => 'Logout efetuado com sucesso'])->withCookie($cookie);
        } catch (Exception $e) {
            return response()->json(['error' => 'Erro ao efetuar logout'], 500);
        }
    }

    // Esta é a função que o NextAuth chamará quando o token expirar
    public function refresh(): JsonResponse
    {
        try {
            $newToken = $this->refreshAction->execute();
            $cookie = $this->setTokenCookieAction->execute($newToken);
            return $this->respondWithToken($newToken, $cookie);
        } catch (Exception $e) {
            return response()->json(['error' => 'Erro ao atualizar token ' . $e->getMessage()], 500);
        }
    }

    // Estrutura padrão de resposta do token
    protected function respondWithToken($token, $cookie = null): JsonResponse
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() // Tempo em segundos
        ])->withCookie($cookie);
    }
}
