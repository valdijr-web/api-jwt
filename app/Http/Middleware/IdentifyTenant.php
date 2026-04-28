<?php

namespace App\Http\Middleware;

use App\Services\TenantManager;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class IdentifyTenant
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = auth('api')->user();// Pega o usuário logado

        // Se o usuário existir e tiver um tenant vinculado, avisa o Manager
        if ($user && $user->tenant_id) {
            $user->loadMissing('tenant'); // evita query duplicada
            app(TenantManager::class)->setTenant($user->tenant);
        }

        return $next($request);
    }
}
