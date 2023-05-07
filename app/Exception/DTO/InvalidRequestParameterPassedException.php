<?php

namespace App\Exception\DTO;

use App\Exception\JsonException;

/**
 * Class InvalidRequestParameterPassedException
 * @pakege App\Exception\DTO
 *
 * @author Otinov Ilya
 */
class InvalidRequestParameterPassedException extends JsonException
{

    /**
     * @return string
     */
    protected function getErrorTitle(): string
    {
        return "Request is invalid";
    }

    /**
     * @return string
     */
    protected function getErrorText(): string
    {
        return $this->getMessage();
    }
}
