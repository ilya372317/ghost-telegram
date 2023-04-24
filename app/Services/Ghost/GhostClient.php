<?php

namespace App\Services\Ghost;

use App\DTO\PostContent;

interface GhostClient
{
    public function createNewPost(PostContent $postContent): void;
}
