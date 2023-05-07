<?php

namespace App\Reflection\Channel\Request;

use Attribute;

#[Attribute(Attribute::TARGET_PROPERTY)]
class RequestPropertyName
{
    public function __construct(
        public string $value
    )
    {
    }
}
