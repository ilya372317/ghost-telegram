<?php

namespace App\Reflection\Channel\Request;


use Attribute;

#[Attribute(Attribute::TARGET_CLASS)]
class GetFromBody
{
    public function __construct(
        public bool $value = true
    )
    {
    }
}
