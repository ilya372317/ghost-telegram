<?php

namespace App\Exception\Elequent;

use App\Exception\JsonException;

/**
 * Class ModelNotFoundException
 * @pakege App\Exception\Eloquent
 *
 * @author Otinov Ilya
 */
class ModelNotFoundException extends JsonException
{
    public function __construct(private readonly int $id)
    {
        parent::__construct();
    }

    private const ERROR_TITLE = 'Model not found';

    /**
     * @return string
     */
    protected function getErrorTitle(): string
    {
        return self::ERROR_TITLE;
    }

    /**
     * @return string
     */
    protected function getErrorText(): string
    {
        return "model with id {$this->id} not found";
    }
}
