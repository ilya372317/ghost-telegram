<?php

namespace App\DTO;

/**
 * Class PostContent
 * @pakege App\DTO
 *
 * @author Otinov Ilya
 */
class PostContent {
    /**
     * @param string $postContent
     * @param string $imagePath
     */
    public function __construct(
        public string $postContent,
        public string $imagePath
    ) {

    }
}
