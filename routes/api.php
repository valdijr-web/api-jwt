<?php

use App\Http\Controllers\Api\V1\AddressController;
use App\Http\Controllers\Api\V1\AuthController;
use App\Http\Controllers\Api\V1\PatientController;
use App\Http\Controllers\Api\V1\TenantController;
use App\Http\Controllers\Api\V1\UserController;
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

            //Route::apiResource('patients', PatientController::class);
            Route::delete('/users/bulk', [UserController::class, 'bulkDelete']);
            Route::patch('users/{user}/status', [UserController::class, 'updateStatus']);
            Route::apiResource('users', UserController::class);

            Route::apiResource('patients', PatientController::class);

            Route::get('/address/zipcode/{zip_code}', [AddressController::class, 'getAddressByZipCode'])->name('address.zipcode');



    });
});
