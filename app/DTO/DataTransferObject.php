<?php

namespace App\DTO;

use App\Exception\DTO\InvalidRequestParameterPassedException;
use App\Exception\DTO\InvalidRequestParamNameException;
use App\Reflection\Channel\Request\GetFromParameters;
use App\Reflection\Channel\Request\RequestPropertyName;
use Illuminate\Http\Request;
use App\Reflection\Channel\Request\GetFromBody;
use ReflectionClass;

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
        $data = self::getData($request);
        $data = self::convertFieldKey($data);
        self::validateRequest($data);

        return new static(...$data);
    }

    /**
     * Converting DTO class keys by RequestPropertyName attribute
     *
     * @return array<string, mixed>
     */
    private static function convertFieldKey(array $data): array
    {
        $reflectionClass = self::getReflection();
        $reflectionProperties = $reflectionClass->getProperties();

        foreach ($reflectionProperties as $reflectionProperty) {
            $reflectionAttributes = $reflectionProperty->getAttributes();
            foreach ($reflectionAttributes as $reflectionAttribute) {
                /** @var RequestPropertyName $attribute */
                $attribute = $reflectionAttribute->newInstance();
                if ($reflectionAttribute->getName() === RequestPropertyName::class) {
                    if (isset($data[$attribute->value])) {
                        $data[$reflectionProperty->name] = $data[$attribute->value];
                        if ($attribute->value !== $reflectionProperty->name) {
                            unset($data[$attribute->value]);
                        }
                    } else if (empty($data)) {
                        return $data;
                    } else {
                        throw new InvalidRequestParamNameException($attribute->value);
                    }
                }
            }
        }

        return $data;
    }

    /**
     * @param Request $request
     * @return array<string, mixed>
     */
    private static function getData(Request $request): array
    {
        $reflectionClass = self::getReflection();
        $classAttributes = $reflectionClass->getAttributes();
        $data = [];
        foreach ($classAttributes as $attribute) {
            $attributeObject = $attribute->newInstance();
            if ($attribute->getName() === GetFromBody::class && $attributeObject->value) {
                $data = array_merge($data, json_decode(($request->getContent()), true) ?? []);
            }
            if ($attribute->getName() === GetFromParameters::class && $attributeObject->value) {
                $data = array_merge($data, $request->all());
            }
        }

        return $data;
    }

    /**
     * @return ReflectionClass
     */
    private static function getReflection(): ReflectionClass
    {
        return new ReflectionClass(static::class);
    }

    /**
     * @param array $data
     * @return void
     */
    private static function validateRequest(array $data): void
    {
        $reflectionClass = self::getReflection();
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
