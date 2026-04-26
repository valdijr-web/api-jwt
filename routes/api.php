<?php

use App\Http\Controllers\Api\V1\AuthController;
use Illuminate\Support\Facades\Route;

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
        Route::post('register', [AuthController::class, 'register']);

        // Rotas que PRECISAM de token (protegidas pelo construtor)
        // O construtor do AuthController já protege estas rotas
        Route::post('logout', [AuthController::class, 'logout']);
        Route::post('refresh', [AuthController::class, 'refresh']);
        Route::post('me', [AuthController::class, 'me'])->middleware(['auth:api']);
    });

     // Grupo de autenticação pública

    // Rotas Protegidas (explicitamente com middleware)
    Route::middleware(['auth:api'])->group(function () {
        // Grupos específicos por funcionalidade
        // Exemplo
        // Route::prefix('admin')->name('admin.')->middleware('role:admin')->group(function () {
        //     Route::get('dashboard', [AdminController::class, 'dashboard']);
        //     Route::apiResource('users', AdminUserController::class);
        // });
    });
});
