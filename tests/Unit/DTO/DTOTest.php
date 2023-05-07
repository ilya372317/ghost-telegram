<?php

namespace Tests\Unit\DTO;

use App\DTO\DataTransferObject;
use App\Reflection\Channel\Request\RequestPropertyName;

/**
 * Class DTOTest
 * @pakege Tests\Unit\DTO
 *
 * @author Otinov Ilya
 */
class DTOTest extends DataTransferObject
{
    /**
     * @param string $field1
     * @param string $field2
     * @param string $field3
     */
    public function __construct(
        #[RequestPropertyName('field1')] public string $field1,
        #[RequestPropertyName('field2')] public string $field2,
        #[RequestPropertyName('field3')] public string $field3,
    )
    {
    }
}
