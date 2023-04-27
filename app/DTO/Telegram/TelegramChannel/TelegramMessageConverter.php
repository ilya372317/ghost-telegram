<?php

namespace App\DTO\Telegram\TelegramChannel;

use App\DTO\Convertable;
use App\DTO\JsonConverter;
use App\Exception\FailedToConvertException;

class TelegramMessageConverter implements JsonConverter
{

    /**
     * @param array $data
     * @return TelegramChannel
     * @throws FailedToConvertException
     */
    public static function convert(array $data): TelegramChannel
    {
        self::validateData($data);
        return new TelegramChannel(
            username: $data['Chat']['username'],
            inviteLink: $data['full']['exported_invite']['link']
        );
    }

    /**
     * @param array $data
     * @return void
     * @throws FailedToConvertException
     */
    private static function validateData(array $data): void
    {
        if (!isset($data['Chat']['username'])) {
            throw new FailedToConvertException("Failed convert channel username");
        }
        if (!isset($data['full']['exported_invite']['link'])) {
            throw new FailedToConvertException("Failed convert channel link");
        }
    }
}
