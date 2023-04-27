<?php

namespace App\DTO\Telegram\TelegramMessage;

use App\DTO\Convertable;
use App\DTO\JsonConverter;
use App\Exception\FailedToConvertException;

class TelegramFromUserMessageConverter implements JsonConverter
{

    /**
     * @param array $data
     * @return TelegramMessage
     * @throws FailedToConvertException
     */
    public static function convert(array $data): TelegramMessage
    {
        self::validateData($data);
        return new TelegramMessage(text: $data['message']);
    }

    /**
     * @param array $data
     * @return void
     * @throws FailedToConvertException
     */
    private static function validateData(array $data): void
    {
        if (! isset($data['message'])) {
            throw new FailedToConvertException("failed to convert message from user!");
        }
    }
}

