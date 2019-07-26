<?php

namespace App\Traits;

use App\User;
use Firebase\JWT\JWT;

trait JWTTrait
{
    /**
     * Create a new JSON Web Token.
     *
     * @param  \App\User $user
     * @return string
     */
    protected function jwt(User $user)
    {
        $payload = [
            'iss' => "innosabi",
            'sub' => $user->id,
            'iat' => time(),
            'exp' => time() + 60 * 60
        ];

        return JWT::encode($payload, env('JWT_SECRET'));
    }
}