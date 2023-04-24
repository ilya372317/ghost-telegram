<?php

namespace App\Services\Ghost;

use App\DTO\PostContent;
use App\Utils\JWT\JwtParser;
use Illuminate\Support\Facades\Http;

class GhostClientService implements GhostClient
{
    private string $jwtToken;

    public function __construct()
    {
        $this->jwtToken = JwtParser::parseToken();
    }

    public function createNewPost(PostContent $postContent): void
    {
        $response = Http::withHeaders(['Authorization' => " Ghost $this->jwtToken"])
            ->get('https://onff.ru/ghost/api/v2/admin/posts');
        dd($response->body());
    }
}
