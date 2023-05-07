<?php

namespace App\DTO\Api\Channel;

use App\DTO\DataTransferObject;

/**
 * Class UpdateChannelDTO
 * @pakege App\DTO\Api\Channel
 *
 * @author Otinov Ilya
 */
class UpdateChannelDTO extends DataTransferObject
{
    public function __construct(public readonly string $username)
    {
    }
}
