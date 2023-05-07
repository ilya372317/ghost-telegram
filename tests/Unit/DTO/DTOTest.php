<?php

namespace Tests\Unit\DTO;

use App\DTO\DataTransferObject;

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
        public string $field1,
        public string $field2,
        public string $field3,
    )
    {
    }
}
