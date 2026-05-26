<?php
namespace App\Actions\Users;

use App\Models\User;
use Exception;
use Illuminate\Support\Facades\DB;

class DeleteUserAction
{
    public function execute(User $user): ?bool
    {
        try {
            return DB::transaction(function () use ($user){
                // Aqui você pode adicionar lógicas extras antes de deletar
                // Ex: Remover avatar do Storage, cancelar assinaturas, etc.
                return $user->delete();
            });
        } catch (Exception $e) {
            throw new Exception("Erro interno ao tentar excluir usuário.");
        }

    }
}
