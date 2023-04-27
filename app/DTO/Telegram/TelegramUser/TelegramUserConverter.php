<?php

namespace App\DTO\Telegram\TelegramUser;

use App\DTO\JsonConverter;
use App\Exception\FailedToConvertException;

class TelegramUserConverter implements JsonConverter
{
    /**
     * @param array $data
     * @return TelegramUser
     * @throws FailedToConvertException
     */
    public static function convert(array $data): TelegramUser
    {
        self::validateData($data);
        return new TelegramUser(
            firstName: $data['User']['first_name'],
            secondName: $data['User']['last_name'],
            userLink: $data['full']['about'],
        );
    }

    /**
     * @param array $data
     * @return void
     * @throws FailedToConvertException
     */
    private static function validateData(array $data): void
    {
        if (!isset($data['full']['about'])) {
            throw new FailedToConvertException("Failed to get link to user");
        }

        if (!isset($data['User']) || !isset($data['User']['first_name']) || ! isset($data['User']['last_name'])) {
            throw new FailedToConvertException("Invalid user info");
        }
    }
}
