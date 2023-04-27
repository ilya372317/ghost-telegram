<?php

namespace App\DTO\Telegram\TelegramUser;

use App\DTO\Convertable;

class TelegramUser implements Convertable
{
    public function __construct(
        public string $firstName,
        public string $secondName,
        public string $userLink
    ) {
    }
}
