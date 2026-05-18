<?php
namespace App\Actions\Users;

use App\Models\User;
use Illuminate\Support\Facades\DB;
use Exception;

class DeleteUsersAction
{
    /**
     * Exclui uma lista de usuários com base nos IDs fornecidos.
     *
     * @param array<int> $userIds
     * @return int Quantidade de usuários excluídos.
     * @throws Exception
     */
    public function execute(array $userIds): int
    {
        return DB::transaction(function () use ($userIds) {
            // Buscamos os usuários primeiro se precisarmos disparar
            // eventos de model (como deletar fotos do S3, etc)
            $users = User::whereIn('id', $userIds)->get();

            $count = 0;
            foreach ($users as $user) {
                $user->delete();
                $count++;
            }

            return $count;
        });
    }
}
