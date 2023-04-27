<?php

namespace App\Utils\JWT;

use Firebase\JWT\JWT;

class JwtParser
{
    public static function parseToken(): string
    {
        $secret = pack('H*', config('ghost.api_secret'));
        $payload = [
            'iat' => time(),
            'exp' => strtotime('+5 minutes'),
            'aud' => "v2/admin"
        ];
        return JWT::encode(
            payload: $payload,
            key: $secret,
            alg: 'HS256',
            keyId: config('ghost.key_id')
        );
    }
}
