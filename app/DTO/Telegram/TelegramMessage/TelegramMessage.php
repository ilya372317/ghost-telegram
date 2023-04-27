<?php

namespace App\DTO\Telegram\TelegramMessage;

use App\DTO\Convertable;

class TelegramMessage implements Convertable
{
    public function __construct(
        public string $text
    )
    {
    }
}
