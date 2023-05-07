<?php

namespace Tests\Unit\DTO;

use App\Reflection\Channel\Request\GetFromBody;

/**
 * Class DTOWithGetFromBodyAttribute
 * @pakege Tests\Unit\DTO
 *
 * @author Otinov Ilya
 */
#[GetFromBody(value: true)]
class DTOWithGetFromBodyAttribute extends DTOTest
{

}
