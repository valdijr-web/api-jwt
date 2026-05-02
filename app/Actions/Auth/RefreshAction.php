<?php
namespace App\Actions\Auth;

class RefreshAction
{
    public function execute(): string
    {
         $newToken = auth('api')->refresh();

        return $newToken;
    }
}
