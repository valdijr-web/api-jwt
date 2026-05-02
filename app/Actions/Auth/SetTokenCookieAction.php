<?php

namespace App\Actions\Auth;

use Symfony\Component\HttpFoundation\Cookie as SymfonyCookie;
use Illuminate\Support\Facades\Cookie;

class SetTokenCookieAction
{
    public function execute($token): SymfonyCookie
    {
        return Cookie::make(
            'access_token',            // nome
            $token,                    // valor
            config('jwt.refresh_ttl'), // tempo de vida em minutos do cookie
            '/',                       // path
            null,                      // domain (null = atual)
            config('session.secure'),  // secure (HTTPS)
            true,                      // httpOnly
            false,                     // raw (false = usar criptografia do Laravel)
            'lax'                      // sameSite
        );
    }
}
