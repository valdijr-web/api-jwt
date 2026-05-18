<?php
namespace App\Actions\Users;

use App\Models\User;
use Illuminate\Support\Facades\DB;

class DeleteUserAction
{
    public function execute(User $user): ?bool
    {
        return DB::transaction(function () use ($user){
            // Aqui você pode adicionar lógicas extras antes de deletar
            // Ex: Remover avatar do Storage, cancelar assinaturas, etc.
            return $user->delete();
        });

    }
}
