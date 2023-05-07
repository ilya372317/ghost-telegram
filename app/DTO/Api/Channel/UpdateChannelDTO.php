<?php

namespace App\DTO\Api\Channel;

use App\DTO\DataTransferObject;
use App\Reflection\Channel\Request\GetFromBody;

/**
 * Class UpdateChannelDTO
 * @pakege App\DTO\Api\Channel
 *
 * @author Otinov Ilya
 */
#[GetFromBody]
class UpdateChannelDTO extends DataTransferObject
{
    public function __construct(public readonly string $username)
    {
    }
}
