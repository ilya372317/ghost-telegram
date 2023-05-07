<?php

namespace App\Exception\DTO;

use App\Exception\JsonException;

class InvalidRequestParameterPassedException extends JsonException
{

    protected function getErrorTitle(): string
    {
        return "Request is invalid";
    }

    protected function getErrorText(): string
    {
        return $this->getMessage();
    }
}
