<?php

namespace App\Exception\DTO;

use App\Exception\JsonException;

/**
 * Class InvalidRequestParamNameException
 * @pakege App\Exception\DTO
 *
 * @author Otinov Ilya
 */
class InvalidRequestParamNameException extends JsonException
{
    /**
     * @param string $propertyName
     */
    public function __construct(
        private readonly string $propertyName
    )
    {
        parent::__construct();
    }

    /**
     * @return string
     */
    protected function getErrorTitle(): string
    {
        return "Property name: {$this->propertyName} not present in request!";
    }

    /**
     * @return string
     */
    protected function getErrorText(): string
    {
        return "Please, ask Ilya fix this!";
    }
}
