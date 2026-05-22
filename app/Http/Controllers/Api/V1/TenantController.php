<?php

namespace App\Http\Controllers\Api\V1;

use App\Actions\Auth\SetTokenCookieAction;
use App\Actions\Tenants\SignupTenantAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\SignupRequest;
use Exception;
use Illuminate\Http\JsonResponse;

class TenantController extends Controller
{
    public function __construct(
        private SignupTenantAction $signupTenantAction,
        private SetTokenCookieAction $setTokenCookieAction
    ) {
    }
    public function signup(SignupRequest $request): JsonResponse
    {

        try {
            $result = $this->signupTenantAction->execute($request->validated());

            $cookie = $this->setTokenCookieAction->execute($result['token']);

            return response()->json($result, 201)->withCookie($cookie);
        } catch (Exception $e) {
            return response()->json(["error" => $e->getMessage() ], 400);
        }

    }
}
