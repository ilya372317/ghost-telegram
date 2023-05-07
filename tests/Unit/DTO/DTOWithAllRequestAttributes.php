<?php

namespace Tests\Unit\DTO;

use App\DTO\DataTransferObject;
use App\Reflection\Channel\Request\GetFromBody;
use App\Reflection\Channel\Request\GetFromParameters;

/**
 * Class DTOWithAllRequestAttributes
 * @pakege Tests\Unit\DTO
 *
 * @author Otinov Ilya
 */
#[GetFromParameters]
#[GetFromBody]
class DTOWithAllRequestAttributes extends DTOTest
{

}
