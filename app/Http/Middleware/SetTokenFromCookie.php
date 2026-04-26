<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SetTokenFromCookie
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Verifica se o header Authorization está vazio E se o cookie existe
        if (!$request->bearerToken() && $request->hasCookie('access_token')) {
            $token = $request->cookie('access_token');

            // Injeta o token no Header da requisição de forma "on-the-fly"
            $request->headers->set('Authorization', 'Bearer ' . $token);
        }

        return $next($request);
    }
}
