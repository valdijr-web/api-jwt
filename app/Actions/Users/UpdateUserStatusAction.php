<?php
namespace App\Actions\Users;

use App\Models\User;

class UpdateUserStatusAction
{
    /**
     * Executa a inversão do status do usuário.
     */
    public function execute(User $user, bool $isActive): User
    {
        if ($user->is_active === $isActive) {
            return $user;
        }
        $user->is_active = $isActive;
        $user->save();

        return $user;
    }
}
