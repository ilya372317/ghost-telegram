<?php

namespace App\DTO\Ghost\Post;

class GhostPost
{
    public function __construct(
        public string $content,
        public string $title,
    ) {
    }
}
