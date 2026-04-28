<?php

use App\Http\Controllers\Api\V1\AuthController;
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
        Route::post('register', [AuthController::class, 'register']);

        // Rotas que PRECISAM de token (protegidas pelo construtor)
        // O construtor do AuthController já protege estas rotas
        Route::post('logout', [AuthController::class, 'logout'])->middleware(['auth:api', 'tenant']);
        Route::post('refresh', [AuthController::class, 'refresh'])->middleware(['auth:api:with_expired', 'tenant']);
        Route::post('me', [AuthController::class, 'me'])->middleware(['auth:api', 'tenant']);
    });

    // Grupo de autenticação pública

    Route::post('/criar', function (Request $request) {
        $user = new User;
        $user->name = 'Valdi';
        $user->email = 'valdi.ads@gmail.com';
        $user->password = Hash::make('123456');
        $user->tenant_id = 1; // Associa o usuário ao tenant com ID 1
        $user->save();


        return response()->json($user, 201);
    });

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
