<?php

use App\Http\Controllers\Api\V1\AuthController;
use App\Http\Controllers\Api\V1\TenantController;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;
use Symfony\Component\HttpFoundation\Request;

/*
|--------------------------------------------------------------------------
| API Routes - V1
|--------------------------------------------------------------------------
*/

Route::prefix('v1')->group(function () {
    // Grupo de autenticação
    Route::prefix('auth')->group(function () {
        // Rotas que NÃO precisam de token (públicas)
        Route::post('login', [AuthController::class, 'login']);

        // Rotas que PRECISAM de token (protegidas pelo construtor)
        // O construtor do AuthController já protege estas rotas
        Route::post('logout', [AuthController::class, 'logout'])->middleware(['auth:api', 'tenant']);
        Route::post('refresh', [AuthController::class, 'refresh'])->middleware(['tenant']);
        Route::post('me', [AuthController::class, 'me'])->middleware(['auth:api', 'tenant']);
    });

    // Grupo de autenticação pública
    Route::post('/signup', [TenantController::class, 'signup']);

    // Rotas Protegidas (explicitamente com middleware)
    Route::middleware(['auth:api', 'tenant'])->group(function () {
        // Grupos específicos por funcionalidade
        // Exemplo
        // Route::prefix('admin')->name('admin.')->middleware('role:admin')->group(function () {
        //     Route::get('dashboard', [AdminController::class, 'dashboard']);
        //     Route::apiResource('users', AdminUserController::class);
        // });
    });
});
