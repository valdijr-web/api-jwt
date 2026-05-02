<?php

namespace App\Http\Controllers\Api\V1;

use App\Actions\Auth\SetTokenCookieAction;
use App\Actions\Tenant\SignupTenantAction;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class TenantController extends Controller
{
    public function __construct(
        private SignupTenantAction $signupTenantAction,
        private SetTokenCookieAction $setTokenCookieAction
    ) {
    }
    public function signup(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'trade_name' => ['required', 'string', 'max:255', 'min:1'],
            'whatsapp_number' => ['required', 'string', 'max:255', 'min:1'],
            'name'         => ['required', 'string', 'max:255'],
            'email'        => ['required', 'email'],
            'password'     => ['required', 'min:6'],
        ]);
        try {
            $result = $this->signupTenantAction->execute($validated);

            $cookie = $this->setTokenCookieAction->execute($result['token']);

            return response()->json($result, 201)->withCookie($cookie);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 400);
        }

    }
}
