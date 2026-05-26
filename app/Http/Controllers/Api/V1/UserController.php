<?php

namespace App\Http\Controllers\Api\V1;

use App\Actions\Users\CreateUserAction;
use App\Actions\Users\DeleteUserAction;
use App\Actions\Users\DeleteUsersAction;
use App\Actions\Users\ListUsersAction;
use App\Actions\Users\UpdateUserAction;
use App\Actions\Users\UpdateUserStatusAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\Users\BulkDeleteRequest;
use App\Http\Requests\Users\CreateUserRequest;
use App\Http\Requests\Users\IndexUserRequest;
use App\Http\Requests\Users\UpdateStatusRequest;
use App\Models\User;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(IndexUserRequest $request, ListUsersAction $action): JsonResponse
    {
        $filters = $request->safe()->only([
            'global_filter',
            'name',
            'email',
            'created_from',
            'created_to',
            'sort_by',
            'sort_direction',
            'per_page',
            'page'
        ]);
        $users = $action->execute($filters);

        return response()->json($users);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateUserRequest $request, CreateUserAction $createUserAction): JsonResponse
    {
        $user = $createUserAction->execute($request->all());
        // 2. Retorna a resposta da API
        return response()->json([
            'user' => $user,
            'message' => 'Usuário criado com sucesso!',
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id): JsonResponse
    {
        $user = User::findOrFail($id);
        return response()->json($user);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id, UpdateUserAction $updateUserAction)
    {
        $user = User::findOrFail($id);

        // Validação básica
        $validated = $request->validate([
            'is_active' => 'boolean',
            'name'   => 'string|max:255',
            // outros campos...
        ]);

        // Executa a Action
        $updatedUser = $updateUserAction->execute($user, $validated);

        return response()->json([
            'message' => 'Usuário atualizado com sucesso',
            'data' => $updatedUser
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user, DeleteUserAction $deleteUser): JsonResponse
    {
        $deleteUser->execute($user);

        return response()->json([
            'message' => 'Usuário excluído com sucesso.'
        ], 200);
    }


    public function bulkDelete(BulkDeleteRequest $request, DeleteUsersAction $deleteUsers): JsonResponse
    {

        $deletedCount = $deleteUsers->execute($request->validated()['user_ids']);
        $message = trans_choice(
            '{1} :count usuário excluído com sucesso!|[2,*] :count usuários excluídos com sucesso!',
            $deletedCount,
            ['count' => $deletedCount]
        );
        return response()->json([
            'message' => $message
        ], 200);
    }

    public function updateStatus(UpdateStatusRequest $request, User $user, UpdateUserStatusAction $action): JsonResponse
    {
        try {
            $user = $action->execute($user, $request->validated()["is_active"]);

            return response()->json([
                'message' => $user->is_active
                    ? 'Usuário ativado com sucesso.'
                    : 'Usuário desativado com sucesso.'
            ], 200);
        } catch (Exception $e) {
            return response()->json(['error' => 'Falha ao atualizar status de usuário'], 500);
        }
    }
}
