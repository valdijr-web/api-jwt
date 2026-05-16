<?php
namespace App\Actions\User;

use App\Models\User;

class UpdateUserAction
{
    public function execute(User $user, array $data): User
    {
        $user->update($data);

        // Aqui você pode adicionar lógicas extras,
        // como disparar eventos se o status mudar
        return $user;
    }
}
