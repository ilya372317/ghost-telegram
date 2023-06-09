<?php

namespace App\DTO\Api\Channel;

use App\DTO\DataTransferObject;
use App\Reflection\Channel\Request\GetFromBody;
use App\Reflection\Channel\Request\RequestPropertyName;

/**
 * Class UpdateChannelDTO
 * @pakege App\DTO\Api\Channel
 *
 * @author Otinov Ilya
 */
#[GetFromBody]
class UpdateChannelDTO extends DataTransferObject
{
    public function __construct(
        #[RequestPropertyName('userName')] public readonly string $username
    )
    {
    }
}
