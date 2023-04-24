<?php

namespace App\Services\Ghost;

use App\DTO\PostContent;

class GhostClientService implements GhostClient
{
    public function __construct(
        private string $apiSecret
    )
    {
        $this->apiSecret = config('ghost.api_key');
    }

    public function createNewPost(PostContent $postContent): void
    {

    }
}
