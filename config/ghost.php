<?php

return [
    'api_secret' => env('GHOST_API_SECRET'),
    'payload' => [
        'iat' => time(),
        'exp' => strtotime('+5 minutes'),
        'aud' => "v2/admin"
    ],
    'key_id' => env('GHOST_KEY_ID')
];
