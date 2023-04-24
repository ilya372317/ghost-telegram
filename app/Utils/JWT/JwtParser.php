<?php

namespace App\Utils\JWT;

use Firebase\JWT\JWT;

class JwtParser
{
    public static function parseToken(): string
    {
        $secret = pack('H*', config('ghost.api_secret'));
        return JWT::encode(
            payload: config('ghost.payload'),
            key: $secret,
            alg: 'HS256',
            keyId: config('ghost.key_id')
        );
    }
}
