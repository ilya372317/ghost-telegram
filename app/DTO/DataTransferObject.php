<?php

namespace App\DTO;

use App\Exception\DTO\InvalidRequestParameterPassedException;
use Doctrine\DBAL\Driver\PgSQL\Exception\UnknownParameter;
use Illuminate\Http\Request;

/**
 * Class DataTransferObject
 * @pakege App\DTO
 *
 * @author Otinov Ilya
 */
abstract class DataTransferObject
{
    /**
     * @param Request $request
     * @return static
     */
    public static function createFromRequest(Request $request): static
    {

        if (!empty($request->all())) {
            $data = $request->all();
        } else {
            $data = json_decode($request->getContent(), true);
        }
        self::validateRequest($data);

        return new static(...$data);
    }

    private static function validateRequest(array $data): void
    {
        $reflectionClass = new \ReflectionClass(static::class);
        $properties = $reflectionClass->getProperties();
        foreach ($properties as $reflectionProperty) {
            if (!in_array($reflectionProperty->name, array_keys($data))) {
                throw new InvalidRequestParameterPassedException(
                    "invalid property passed to data transfer object class}"
                );
            }
        }

    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        return (array)$this;
    }
}
