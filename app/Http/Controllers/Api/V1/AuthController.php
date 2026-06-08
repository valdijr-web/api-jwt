<?php

namespace App\Http\Controllers\Api\V1;

use App\Actions\Auth\LoginAction;
use App\Actions\Auth\LogoutAction;
use App\Actions\Auth\RefreshAction;
use App\Actions\Auth\SetTokenCookieAction;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\JsonResponse;

class AuthController extends Controller
{
    // Construtor para proteger as rotas, exceto login e registo
    public function __construct(
        private SetTokenCookieAction $setTokenCookieAction
    ) {
        $this->middleware('auth:api')->except(['login', 'register', 'refresh' ]);
    }

    public function login(LoginRequest $request, LoginAction $loginAction): JsonResponse
    {
        // 1. Verifica se excedeu o limite de tentativas (bloqueia com 422 automático se estourar)
        $request->ensureIsNotRateLimited();
        $credentials = $request->safe()->only(['email', 'password']);

        try {
            $token = $loginAction->execute($credentials);

            // Se o login deu certo, limpamos o contador de bloqueio do IP/E-mail
            $request->clearRateLimiter();

            // Cria o cookie HttpOnly contendo o JWT
            $cookie = $this->setTokenCookieAction->execute($token);
            return $this->respondWithToken($token, $cookie);
        } catch (Exception $e) {
            // Se falhou (Credenciais inválidas), contamos como um erro no Rate Limiter
            $request->hitRateLimiter();
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

    public function logout(LogoutAction $logoutAction): JsonResponse
    {
        try {
            $logoutAction->execute();
            $cookie = $this->setTokenCookieAction->execute('');
            return response()->json(['message' => 'Logout efetuado com sucesso'])->withCookie($cookie);
        } catch (Exception $e) {
            return response()->json(['error' => 'Erro ao efetuar logout'], 500);
        }
    }

    // Esta é a função que o NextAuth chamará quando o token expirar
    public function refresh(RefreshAction $refreshAction): JsonResponse
    {
        try {
            $newToken = $refreshAction->execute();
            $cookie = $this->setTokenCookieAction->execute($newToken);
            return $this->respondWithToken($newToken, $cookie);
        } catch (Exception $e) {
            $cookie = $this->setTokenCookieAction->execute("");
            return response()->json(['error' => 'Token expirado e não pode mais ser renovado. Faça login novamente.'], 401)->withCookie($cookie);
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
