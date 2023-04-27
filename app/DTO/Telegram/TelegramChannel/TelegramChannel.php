<?php

namespace App\DTO\Telegram\TelegramChannel;

use App\DTO\Convertable;

class TelegramChannel implements Convertable
{
    public function __construct(
        public string $username,
        public string $inviteLink
    ) {
    }
}
